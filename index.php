<?php
/**
 * Created by PhpStorm.
 * User: anas
 * Date: 1/14/14
 * Time: 9:29 PM
 */
//include('includes/page.php');
?>
<?php include('../scripts/getPageContent.php');
include('variables.php');?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $SiteHeader;?></title>
    <link rel="stylesheet" type="text/css" href=""/>
</head>
<body>
<?php include('header.php');?>
<?php include('nav.php');?>
THE PAGE SHOULD FOLLOW
<?php
echo "<h3>".getPageName()."</h3><br>";
//echo getPageContent(getPageName());
echo "ASdsd"
?>
THE PAGE SHOULD END
<?php include('sidebar.php');?>
<?php include('footer.php');?>
</body>
</html>

