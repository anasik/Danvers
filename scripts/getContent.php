<?php
include('includes/variables.php');
include('scripts/theming.php');
include("scripts/assets/parsedown.php");
include("scripts/assets/DataBag.php");
include("scripts/assets/txparser.php");
include("scripts/assets/Tag.php");
function GetPagesURL() {
    $pageURL = 'http';
  //  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	if(!empty($_SERVER["HTTPS"])) {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
function getPageName() {
    /*substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    return*/
    $url = GetPagesURL();
    $query = parse_url($url, PHP_URL_QUERY);
    if (strpos($query,'page=') !== false) {
//        $page = substr($query, strpos($query,"page=") +5);
	$page = $_GET['page'];
        return $page;
	}
	elseif(strpos($query,'post=') !== false){   
	$page = $_GET['post'];
        return $page;
}
    else {
        return "home";

    }

}
function getPageContent($name){

global $ThemeDir;
    $url = GetPagesURL();
    $query = parse_url($url, PHP_URL_QUERY);
    if (strpos($query,'post=') !== false) {
	$type = "post"; 
	if(findPostPage($name)){
		$pagename = findPostPage($name);
		$pagename = substr($pagename,0,strrpos($pagename,"."));
		$postdate = substr($pagename,0,10);
		$xml = breakItDown(findPostPage($name));
	} else {
		$pagename = $name;
	}
} else {
	$type = "page";
	$pagename = $name;
	}	
    $address = "content/{$type}s/{$pagename}.html";
    $upaddress = "content/{$type}s/{$pagename}.HTML";
    $addrest = "content/{$type}s/{$pagename}.textile";
    $upaddrest = "content/{$type}s/{$pagename}.TEXTILE";
    $addresm = "content/{$type}s/{$pagename}.md";
    $upaddresm = "content/{$type}s/{$pagename}.MD";
    $addre2m = "content/{$type}s/{$pagename}.markdown";
    $upaddre2m = "content/{$type}s/{$pagename}.MARKDOWN";
    if(file_exists($address) or file_exists($upaddress)){
	if(file_exists($address)){
		$markup = file_get_contents($address);}
	else {
		$markup = file_get_contents($upaddress);}
    }
  /*      elseif((file_exists($addrest) and (file_exists($addresm) or file_exists($addre2m))) or (!file_exists($address) and !file_exists($addrest) and !file_exists($addresm) and !file_exists($addre2m)) ) {
        return "Error 404:<br>The Page: {$pagename}, was not found.<br>";
    }*/ elseif(file_exists($addrest) and !file_exists($addresm) and !file_exists($addre2m)){
	 	$parser = new \Netcarver\Textile\Parser();
		$markup = $parser->parse(file_get_contents($addrest));
	} elseif((file_exists($addresm) and !file_exists($addre2m)) and !file_exists($addrest)){
			$Parsedown = new Parsedown();
			$markup = $Parsedown->text(file_get_contents($addresm));
} elseif((file_exists($addre2m) and !file_exists($addresm)) and !file_exists($addrest)){
			$Parsedown = new Parsedown();
			$markup = $Parsedown->text(file_get_contents($addre2m));
}  else {
	return "Error 404:<br>The Page: {$name}, was not found.<br>";}
	if($type=="page"){ 
	$markup = str_replace("@_#_blog_#_@",getPosts(),$markup);
	$template = file_get_contents("{$ThemeDir}/page.html");
	} else {
	$template = file_get_contents("{$ThemeDir}/post.html");
	$markup = str_replace("@_#_metadata_#_@".metaData(findPostPage($name))[1]."#_@_metadata_@_#","",$markup);
	}
	if($xml->title){
	$template = str_replace("@_#_pagename_#_@",$xml[1],$template);}
	else {
	$template = str_replace("@_#_pagename_#_@",$name,$template);}
	$template = str_replace("@_#_postdate_#_@",$postdate,$template);
	$template = str_replace("@_#_postcategs_#_@",$xml[4],$template);
	$template = str_replace("@_#_postauthor_#_@",$xml[3],$template);
	$template = str_replace("@_#_comments_#_@",getComments($name),$template);
	$form = '<form action="scripts/comment.php" method="post" id="commentform">'.file_get_contents($ThemeDir."/commentform.html")."<input type='hidden' disabled value='{$name}' name='here'/></form>";
	$template = str_replace("@_#_pagecontent_#_@",$markup,$template);
	if(substr_count($form,"@_#_ajaxcomment_#_@")){
	$ajaxscript = '<script>
//AJAX post comment.
$(document).ready(function(){
    $("button#ajxcomment").click(function(){
   $.ajax({url: "scripts/comment.php", type: "POST", data: {ctrname: $("input#ctrname").val(),
          email: $("input#email").val(), title: $("input#title").val(), comment: $("textarea#comment").val()}, success: function(result){
       if(result == false){alert("Invalid or incomplete input."); } else{$("#commentform input:text").val("");$("#commentform #comment").val("");}
    }});    
    });
});
</script>';$form .= $ajaxscript;$form = str_replace("@_#_ajaxcomment_#_@","",$form);$form .= "<button id='ajxcomment'>Comment</button>";
	$template = str_replace("@_#_commentform_#_@",$form,$template);
        return $template;}
};
function findPostPage($title){
      	$dirlist =  scandir('content/posts');
        $list = array();
        foreach($dirlist as $filen){
                if(checkMarkupType($filen)){
                        array_push($list,$filen);
                }
        }
        foreach($list as $i => $post){
                if(breakItDown($post)[2] == $title ){return $post;}
        }
}
function getPosts(){
	$dirlist =  scandir('content/posts');
	$list = array();
	global $posts;
	$posts = array();
	foreach($dirlist as $filen){
		if(checkMarkupType($filen)){
			array_push($list,$filen);
		}
	}
	natsort($list);$list = array_reverse($list);
	foreach($list as $i => $post){
		$address = ("content/posts/{$post}");
		switch(checkMarkupType($post)){
			case "html":
			$markup = file_get_contents($address);
			break;

			case "md":
			case "markdown":
			$Parsedown = new Parsedown();
			$markup = $Parsedown->text(file_get_contents($address));
			break;

			case "textile":
			$parser = new \Netcarver\Textile\Parser();
			$markup = $parser->parse(file_get_contents($address));
			break;
		}
			$return = $return.createPost($i,$post,$markup);
	}
	return $return;
}
function getArchive($type,$name){
	$dirlist =  scandir('content/posts');
	$list = array();
	global $posts;
	$posts = array();
	foreach($dirlist as $filen){
		if($type=="a") {
			if(breakItDown($filen)[5]==$name){
			 array_push($list,$filen);
			}
		}
		elseif($type=="c"){
			if(substr_count(breakItDown($filen)[6],$name)){
			array_push($list,$filen);
			}
		}
	}
	natsort($list);$list = array_reverse($list);
	foreach($list as $i => $post){
		$address = ("content/posts/{$post}");
		switch(checkMarkupType($post)){
			case "html":
			$markup = file_get_contents($address);
			break;

			case "md":
			case "markdown":
			$Parsedown = new Parsedown();
			$markup = $Parsedown->text(file_get_contents($address));
			break;

			case "textile":
			$parser = new \Netcarver\Textile\Parser();
			$markup = $parser->parse(file_get_contents($address));
			break;
		}
			$return = $return.createPost($i,$post,$markup);
	}
	return $return;
}
function checkMarkupType($name){
	$file_parts = pathinfo($name);

switch(strtolower($file_parts['extension']))
{
    case "md":
    return "md";
    break;

    case "markdown":
    return "md";
    break;
    
case "html":
return "html";
break;

case "textile":
return "textile";
break;

default:    
break;
}
};
function breakItDown($file){
	$xml=metaData($file)[0];
	$name = pathinfo($file)["filename"];
	$date = substr($name,0,10);
	if($xml->title){
		$title = $xml->title;
		$ftitle = substr($name, 11);
	}	
	else {
		$title = substr($name, 11);
		$ftitle = substr($name, 11);
	}
	if($xml->author){
		global $homeURL;
		$author= $xml->author;
		$authxor="<a href='{$homeURL}archive.php?type=a&name={$author}'>{$author}</a>";
	}	
	if($xml->categories){
		$categories=$xml->categories->children();
		$categs = "";$i=0; $categx;
	foreach($categories as $category){
		if($i == 0){
			$categs .= $category;
			$categx .= "<a href='{$homeURL}archive.php?type=c&name={$category}'>{$category}</a>";
			$i++;
		}
		else {
			$categs .= ", {$category}";$i++;
			$categx .= ", <a href='{$homeURL}archive.php?type=c&name={$category}'>{$category}</a>";
		}
	}
	}
	return array($date,$title,$ftitle,$authxor,$categx,$author,$categs);
}
function metaData($file){
	$contents = file_get_contents("content/posts/{$file}");
        if(substr_count($contents,"@_#_metadata_#_@")){
                $meta=substr($contents,strpos($contents,"@_#_metadata_#_@")+16,strpos($contents,"#_@_metadata_@_#")-16);
		$xml=simplexml_load_string("<meta>".$meta."</meta>");
		return array($xml,$meta);	
        }
}
function createPost($i,$fname,$markup) {
	global $posts;global $ThemeDir;global $homeURL;
	$meta = breakItDown($fname);
	array_push($posts,new Post($meta[0],$meta[1],$markup));
	if($meta[3]){
		$posts[$i]->addAuthor($meta[3]);
	}
	if($meta[4]){
		$posts[$i]->addCateg($meta[4]);
	}
	$layout = file_get_contents("{$ThemeDir}/blog.html");
	$layout = str_replace("@_#_posttitle_#_@",$posts[$i]->ptitle,$layout);
	$layout = str_replace("@_#_postdate_#_@",$posts[$i]->date,$layout);
	$layout = str_replace("@_#_postcontent_#_@",$posts[$i]->contents,$layout);
	$layout = str_replace("@_#_postcategs_#_@",$posts[$i]->categories,$layout);
	$layout = str_replace("@_#_postauthor_#_@",$posts[$i]->author,$layout);
	$layout = str_replace("@_#_permalink_#_@","{$homeURL}?post={$meta[2]}",$layout);
	$layout = str_replace("@_#_metadata_#_@".metaData($fname)[1]."#_@_metadata_@_#","",$layout);
	return $layout;
}
function getComments($post){
	$post = findPostPage($post);
	$ext = "{$post}.json";
	$dir = scandir("content/comments/approved");
	natsort($dir);
	$dir = array_reverse($dir);
	global $comments;
	$comments = array();
	global $ThemeDir;
	foreach($dir as $file){
		if(substr($file,20, strlen($file)-19)==$ext){
			$json = file_get_contents("content/comments/approved/{$file}");
			$comment = json_decode($json);
			$d=substr($file,0,20);$n=$comment->{'name'};$e=$comment->{"email"};
			$t=$comment->{'title'};$c=$comment->{"content"};
			array_push($comments,new Comment($d,$n,$e,$t,$c));
		}
	}	
	foreach($comments as $comment){
		$template = file_get_contents("{$ThemeDir}/comment.html");
		$template = str_replace("@_#_date_#_@",$comment->stamp,$template);
		$template = str_replace("@_#_name_#_@",$comment->ctrname,$template);
		$template = str_replace("@_#_email_#_@",$comment->email,$template);
		$template = str_replace("@_#_title_#_@",$comment->ctitle,$template);
		$template = str_replace("@_#_content_#_@",$comment->contents,$template);
		$markup .= $template;
	}
	return $markup;
}
class Content {
}
class Post extends Content {
	public $date;
	public $ptitle;
	public $contents;
	public $categories;
	public $author;
	public function __construct($d,$t,$c){
		$this->date = $d;
		$this->ptitle = $t;
		$this->contents = $c;
	}
	public function addAuthor($a){
		$this->author = $a;
	}
	public function addCateg($c){
		$this->categories = $c;
	}
}
class Page extends Content {
	public $ptitle;
	public $contents;
	public function __construct($t,$c){
		$this->contents = $c;
		$this->ptitle = $t;
	}
}
class Comment extends Content {
	public $stamp;
	public $ctrname;
	public $email;
	public $ctitle;
	public $contents;
	public function __construct($d,$n,$e,$t,$c){
		$this->stamp=$d;
		$this->ctrname=$n;
		$this->email=$e;
		$this->ctitle=$t;
		$this->contents=$c;
	}
}
?>

