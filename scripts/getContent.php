<?php
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
function getPageContent($pagename){

    $url = GetPagesURL();
    $query = parse_url($url, PHP_URL_QUERY);
    if (strpos($query,'post=') !== false) {
	$type = "post"; 
	$pagename = findPostPage($pagename);
	$pagename = substr($pagename,0,strrpos($pagename,"."));
	} else {
	$type = "page";
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
	return "Error 404:<br>The Page: {$pagename}, was not found.<br>";}
	if($type=="page"){ $markup = str_replace("@_#_blog_#_@",getPosts(),$markup);}
        return '<div id="board">'.$markup.'</div><br>';
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
                if(breakItDown($post)[1] ==$title ){return $post;}
                else {return false;}
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
		$name = pathinfo($file)["filename"];
		$date = substr($name,0,10);
		$title = substr($name, 11);
	return array($date,$title);
}
function createPost($i,$fname,$markup) {
	global $posts;
	$meta = breakItDown($fname);
	array_push($posts,new Post($meta[0],$meta[1],$markup));
	$layout = file_get_contents('includes/postmarkup.html');
	$layout = str_replace("@_#_posttitle_#_@",$posts[$i]->ptitle,$layout);
	$layout = str_replace("@_#_postdate_#_@",$posts[$i]->date,$layout);
	$layout = str_replace("@_#_postcontent_#_@",$posts[$i]->contents,$layout);
	return $layout;
}
class Content {
}

class Post extends Content {
	public $date;
	public $ptitle;
	public $contents;
	public $category;
	public function __construct($d,$t,$c){
		$this->date = $d;
		$this->ptitle = $t;
		$this->contents = $c;

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
class Comments extends Content {}
?>

