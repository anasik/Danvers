<?php
$ThemeName = "default"; //would be the same as the name of the DIR with the themes files
$ThemeDir = "themes/" . $ThemeName;
$ThemeMarkup = file_get_contents($ThemeDir . "/markup.html");

function GetAttributes($tagName){
    global $ThemeDir;
    include($ThemeDir. "/attributes.php");
    return $ThemeAttrs[$tagName];
}
echo GetAttributes("header");
?>