<?php
// Connecting To Database On Localhost Server
if (!isset($NoConnect)) {include "connect.php";}
//Routes
$func    = "includes/functions/"; // Functions Directory
$tpl     = "includes/templates/"; // Templates Directory
$css     = "layout/css/"; // Css Directory
$fonts   = "layout/fonts"; // Fonts Directory
$images  = "layout/images/"; // Images Directory
$js      = "layout/js/"; // Js Directory
$uploads = "data/uploads/"; // Data Directory
// Include The Important Files
include $func . "pagetitle.php";
// Include Header Intro On Pages Where $HeaderIntro variable Is Defined Else Include Header
if (isset($HeaderIntro)) {include $tpl . "header_intro.Php";} else {include $tpl . "header.php";}
// Include Images
if (!isset($NoConnect)) {
 session_start();
 if (isset($_SESSION['ID_CLIENT'])) {
  $grabim    = "SELECT image FROM personne WHERE ID=" . $_SESSION['ID_CLIENT'];
  $resgrabim = $conn->query($grabim);
  while ($r = $resgrabim->fetch_assoc()) {
   if ($r['image'] == 'Client') {
    $imageclient = $images . "Client.png";
   } else {
    $imageclient = $uploads . $_SESSION['image'];
   }
  }
 }
 if (isset($_SESSION['ID_EMPLOYE'])) {
  $grabim    = "SELECT image FROM personne WHERE ID=" . $_SESSION['ID_EMPLOYE'];
  $resgrabim = $conn->query($grabim);
  while ($r = $resgrabim->fetch_assoc()) {
   if ($r['image'] == 'Employé') {
    $imageemploye = $images . "Employe.png";
   } else {
    $imageemploye = $uploads . $_SESSION['imageemp'];
   }
  }
 }
}
// Include Navbar Of Client Or Employe
if (isset($ClientNavbar)) {include $tpl . "client_navbar.php";}
if (isset($EmployeNavbar)) {include $tpl . "employe_navbar.php";}
