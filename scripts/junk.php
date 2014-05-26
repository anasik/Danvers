<?php
$url = 'http://username:password@hostname/path?arg=value#anchor';

print_r(parse_url());

echo parse_url($url, PHP_URL_PATH);
/*----------------------------------------
 * $fileNameInAddress = substr($address, strpos($address,"pages/") +6, strlen($address) -1 );
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

