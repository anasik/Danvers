<?php 
include('scripts/getContent.php');
?>
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
echo getPageContent(getPageName());
?>
</div>
<?php include('includes/footer.php');?>
</body>
</html>
