<?php
/**
 * Created by PhpStorm.
 * User: anas
 * Date: 1/15/14
 * Time: 9:40 PM
 */
include("parse.php");
function getPageContent($pagename){
<<<<<<< HEAD
    $address = "../pages/{$pagename}.html";
    if(file_exists($address)){
        return '<object id="board" type="text/html" data="{$address}"></object>';
=======
    $address = "../pages/{$pagename}";
    if(file_exists($address)){
        return '<object id="board" type="text/html" data="'.$pagename.'.html"></object>';
>>>>>>> 47ed1ec21477ffe37a3a775f34abf2eda5594351
    }
    else {
        return "Error 404:<br>The Page: {$pagename}, was not found.<br>";
    };
};
echo getPageContent(getPageName());
<<<<<<< HEAD

include("../pages/include.html")?>
=======
?>
>>>>>>> 47ed1ec21477ffe37a3a775f34abf2eda5594351
