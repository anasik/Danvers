<?php 
include('scripts/getPageContent.php');
include('includes/variables.php');
include('scripts/theming.php')?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $siteTitle;?></title>
    <?php echo $ThemeMarkup; ?>
</head>
<body>
<?php include('includes/nav.php');?>
<div class="container">
<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>
<?php
echo "<h3>".getPageName()."</h3><br>";
echo getPageContent(getPageName());
getPosts();
?>
</div>
<?php include('includes/footer.php');?>
</body>
</html>