<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8"/>
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width"/>
<title><?=COMPANY?></title>
<!-- CSS Files-->
<link rel="stylesheet" href="<?=base_url()?>public/css/style-citrus.css">
<link rel="stylesheet" href="<?=base_url()?>public/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?=base_url()?>public/css/homepage.css"><!-- homepage stylesheet -->
<link rel="stylesheet" href="<?=base_url()?>public/css/skins/blue.css"><!-- skin color -->
<link rel="stylesheet" href="<?=base_url()?>public/css/responsive.css">
<link rel="shortcut icon" href="favicon.ico">
<?php
if ($this->router->method == 'bartpe') 
{
    echo '<link rel="stylesheet" href="'.base_url().'public/css/prettyphoto.css">';
}
?>
<?php
if ($this->router->method == 'devrecov_form') 
{
    echo '<link rel="stylesheet" href="'.base_url().'public/css/jquery.datetimepicker.css">';
}
?>
<?php
//if ($this->router->method == '') 
//{
//    echo '<link rel="stylesheet" href="'.base_url().'public/css/blog.css">';
//}
//?>
<!-- Load Jquery -->
<?php
    
    echo '<script src="'.base_url().'public/js/jquery.js"'.'></script>';
?>
<!-- IE Fix for HTML5 Tags -->
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
<?php

// If there was an error while getting the $charging_object, the value
// "error" will be set to "ERROR".
if ($charging_object["status"] != "OK"){
    echo '<p>Error: ', $charging_object["error_message"], "</p>";
    exit();
}
?>
</head>
<body>