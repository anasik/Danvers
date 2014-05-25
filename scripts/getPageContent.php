<?php
/**
 * Created by PhpStorm.
 * User: anas
 * Date: 1/15/14
 * Time: 9:40 PM
 */
include("parse.php");
function getPageContent($pagename){
    $address = strtolower("pages/{$pagename}.html");
    if(file_exists($address)){
        return '<div id="board">'.$address.'</div><br>';
    }
        else {
        return "Error 404:<br>The Page: {$pagename}, was not found.<br>";
    };
};
/*$fileNameInAddress = substr($address, strpos($address,"pages/") +6, strlen($address) -1 );
function caseMaker($strng,$cas){
    switch($cas) {
        case "u" or "U":
            $newstr = substr_replace($strng, strtoupper($strng), 0 , strlen($address));
            break;
        case "l" or "L":
            $newstr = substr_replace($strng, strtolower($strng), 0 , strlen($address));
            break;
        case "c" or "C":
            $newstr = substr_replace($strng, ucfirst($strng), 0 , strlen($address));
            break;
        case 'cw' or "CW" or "Cw" or "cW":
            $newstr = substr_replace($strng, ucwords($strng), 0 , strlen($address));
            break;

    }
}*/
/*$addressContents = file_get_contents($address);
 * strtoupper();
strtolower()
ucfirst()
ucwords()*/
?>

