<?php include('..scripts/getPageContent.php');
include('variables.php');?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $SiteTitle;?></title>
    <link rel="stylesheet" type="text/css" href=""/>
    <!---Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('includes/nav.php');?>
<?php include('includes/header.php');?>
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