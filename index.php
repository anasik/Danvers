<?php 
include('scripts/getContent.php');
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
