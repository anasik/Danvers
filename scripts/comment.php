<?php
chdir('..');
include("getContent.php");
function postComment(){
$json = '{ 
"name": "'.$_POST['ctrname'].'",  
"email": "'.$_POST['email'].'", 
"title": "'.$_POST['title'].'",  
"content": "'.htmlspecialchars($_POST['comment']).'"
}'; 
$name = $_SERVER['HTTP_REFERER'];
$name = substr($name , strpos($name,"?post=")+6);
$name = str_replace("%20"," ",$name);
$name = findPostPage($name);
$name= date("Y-m-d H:i:s").".".$name;echo $name; 
$myfile = fopen("content/comments/{$name}.json", "w");
fwrite($myfile,$json);
}
postComment();
?>
