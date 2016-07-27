<?php
chdir('..');
include("getContent.php");
function postComment(){
if($_POST['ctrname'] and $_POST['email'] and $_POST['title'] and htmlspecialchars($_POST['ctrname'])){
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
$name= date("Y-m-d H:i:s").".".$name;
$myfile = fopen("content/comments/{$name}.json", "w");
fwrite($myfile,$json);
echo "Comment posted, awaiting approval...";
} else {
//echo "Invalid or incomplete data. Let me escort you back...";
return false;
	}
sleep(3);
echo "<script>window.location.replace('{$_SERVER['HTTP_REFERER']}');</script>";
die();
}
postComment();
?>
