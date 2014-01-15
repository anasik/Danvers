<?php include('../scripts/getPageContent.php')
/**
 * Created by PhpStorm.
 * User: anas
 * Date: 1/14/14
 * Time: 9:25 PM
 */ ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $SiteHeader;?></title>
    <link rel="stylesheet" type="text/css" href=""/>
</head>
<body>
<?php include('header.php');?>
<?php include('nav.php');?>
----------------------------------------------
<?php
    echo "<h3>".getPageName()."</h3><br>";
    echo getPageContent(getPageName());
?>
-----------------------------------------------

<?php include('sidebar.php');?>
<?php include('footer.php');?>
</body>
</html>