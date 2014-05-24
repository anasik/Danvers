<?php
/**
 * Created by PhpStorm.
 * User: anas
 * Date: 1/15/14
 * Time: 8:58 PM
 */

function GetPagesURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
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
    $page = substr($query, strpos($query,".com/") +4);
    return $page;

}
?>