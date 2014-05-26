<?php
include("parse.php");
function getPageContent($pagename){
    $address = strtolower("pages/{$pagename}.html");
    if(file_exists($address)){
        return '<div id="board">'.file_get_contents($address).'</div><br>';
    }
        else {
        return "Error 404:<br>The Page: {$pagename}, was not found.<br>";
    };
};
?>

