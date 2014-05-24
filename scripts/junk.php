<?php
/**
 * Created by PhpStorm.
 * User: anas
 * Date: 1/15/14
 * Time: 8:58 PM
 */
<?php
$url = 'http://username:password@hostname/path?arg=value#anchor';

print_r(parse_url());

echo parse_url($url, PHP_URL_PATH);
?>
    ----------------------------------------
