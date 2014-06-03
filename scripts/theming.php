<?php
$ThemeName = "default"; //would be the same as the name of the DIR with the themes files
$ThemeDir = "themes/" . $ThemeName;
$ThemeMarkup = file_get_contents($ThemeDir . "/markup.html");

function GetAttributes($tagName){
    global $ThemeName, $ThemeDir;
    include("../themes/default/attributes.php");
    global $ThemeAttrs;
    if(array_key_exists($tagName, $ThemeAttrs)){
        return $ThemeAttrs[$tagName];
    }
    else {
        return "nope";
    };
};
echo $ThemeAttrs;
echo GetAttributes("header");
?>

