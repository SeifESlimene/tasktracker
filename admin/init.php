<?php
if (!isset($NoConnect)) {include "connect.php";}
//Routes
$tpl    = "includes/templates/"; // Templates Directory
$func   = "includes/functions/"; // Functions Directory
$css    = "layout/css/"; // Css Directory
$js     = "layout/js/"; // Js Directory
$images = "layout/images/"; // Images Directory
$fonts  = "layout/fonts"; // Fonts Directory
// Include The Important Files
include $func . "pagetitle.php";
// Include Header
include $tpl . "header.php";
// Include Images
$imageAdmin = $images . "M.S Pro.jpg";
// Include Navbar On All Pages Except The One With $noNavbar variable
if (!isset($noNavbar)) {include $tpl . "navbar.php";}