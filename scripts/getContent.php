<?php
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
    } /*else if(strpos($query,'page=') + 5  == false)) {
        return "home";
    }*/
    else {
        return "home";

    }

}
function getPageContent($pagename){
    $address = strtolower("content/pages/{$pagename}.html");
    if(file_exists($address)){
        return '<div id="board">'.file_get_contents($address).'</div><br>';
    }
        else {
        return "Error 404:<br>The Page: {$pagename}, was not found.<br>";
    };
};
function getPosts(){
	$list =  scandir('content/posts');
	foreach($list as $i => $post){
		if($i>1){
		$address = ("content/posts/{$post}");
		echo "<h2>{$post}</h2><br><br>".file_get_contents($address)."<br><br>";}
	}
}
?>

