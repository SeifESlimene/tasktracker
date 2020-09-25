<?php
$noNavbar = "";
include 'init.php';
if (isset($_GET['id_tache'])) {
 if (!empty($_GET['id_tache'])) {
  $id_tache      = $_GET['id_tache'];
  $req_aff_negoc = "update tache set etat_aff=1, etat_negoc=0 where ID=" . $id_tache . ";";
  $conn->query($req_aff_negoc);
  header('location:liste_negoc.php?p=' . $_GET['p']);
 }
}