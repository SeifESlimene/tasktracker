<?php
$title = "Validation";
include 'init.php';
?>

<?php
if (isset($_GET['idtacheval'])) {
 if (!empty($_GET['idtacheval'])) {
  $req  = "update tache set pourcentage=100 where ID=" . $_GET['idtacheval'];
  $res  = $conn->query($req);
  $req1 = "update compte_rendu set Etat=1 where REFTACHE=" . $_GET['idtacheval'];
  $res1 = $conn->query($req1);
  header('location:avancement.php');
 }
} elseif (isset($_GET['idtachepasval'])) {
 if (!empty($_GET['idtachepasval'])) {
  $req  = "update tache set pourcentage=0 where ID=" . $_GET['idtachepasval'];
  $res  = $conn->query($req);
  $req1 = "update compte_rendu set Etat=2 where REFTACHE=" . $_GET['idtachepasval'];
  $res1 = $conn->query($req1);
  header('location:avancement.php');
 }
}
?>

<?php include $tpl . "footer.php"; ?>