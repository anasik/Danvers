<?php include('scripts/getPageContent.php');
include('includes/variables.php');?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $SiteTitle;?></title>
    <link rel="stylesheet" type="text/css" href=""/>
</head>
<body>
<?php include('includes/header.php');?>
<?php include('includes/nav.php');?>
---------------------------------------------------
<?php
echo "<h3>".getPageName()."</h3><br>";
echo getPageContent(getPageName());
?>
---------------------------------------------------
<?php include('includes/sidebar.php');?>
<?php include('includes/footer.php');?>
</body>
</html>