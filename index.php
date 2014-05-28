<?php include('scripts/getPageContent.php');
include('includes/variables.php');
include('scripts/theming.php')?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $siteTitle;?></title>
    <?php echo setTheme(); ?>
</head>
<body>
<?php include('includes/nav.php');?>
<div class="container">
<?php include('includes/header.php');?>
---------------------------------------------------
<?php
echo "<h3>".getPageName()."</h3><br>";
echo getPageContent(getPageName());
?>
---------------------------------------------------
<?php include('includes/sidebar.php');?>
</div>
<?php include('includes/footer.php');?>
</body>
</html>