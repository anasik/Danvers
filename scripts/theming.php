<?php
$ThemeName = "default"; //would be the same as the name of the DIR with the themes files
$ThemeDir = "themes/" . $ThemeName;
$ThemeMarkup = file_get_contents($ThemeDir . "/markup.html");
$attraddress = $ThemeDir . "/attributes.php";
include $attraddress;

function GetAttributes($tagName){
    global $ThemeAttrs;
    if(array_key_exists($tagName, $ThemeAttrs)){
        return $ThemeAttrs[$tagName];
    }
    else {
        return "nope";
    }
}
echo $ThemeAttrs;
echo GetAttributes("header");
?>

