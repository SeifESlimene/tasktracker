<?php
$title        = "Espace Client";
$ClientNavbar = "";
$BodyAtt      = "id='dashboard'";
include 'init.php';
?>
<?php
if (empty($_SESSION['Email_Client'])) {
 header('location:login_client.php');
} else {
 $pt  = 0;
 $req = 'select count(*) from client;';
 $q   = $conn->query($req);
 $clt = array();
 while ($r = $q->fetch_assoc()) {
  $clt = $r;
 }
 foreach ($clt as $c) {
  $a = $c;
 }
 $req2 = "select count(*) as nbrproj from projet where Refclient = " . $_SESSION['ID_CLIENT'];
 $q2   = $conn->query($req2);
 $clt2 = array();
 while ($r2 = $q2->fetch_assoc()) {
  $clt2 = $r2;
 }
 foreach ($clt2 as $c2) {
  $b = $c2;
 }
 $req3 = 'select count(*) from projet;';
 $q3   = $conn->query($req3);
 $clt3 = array();
 while ($r3 = $q3->fetch_assoc()) {
  $clt3 = $r3;
 }
 foreach ($clt3 as $c3) {
  $c = $c3;
 }
 $req4 = "select * from projet where Refclient = " . $_SESSION['ID_CLIENT'];
 $q4   = $conn->query($req4);
 while ($rr4 = $q4->fetch_assoc()) {
  $req88 = "select sum(pourcentage) as projter from tache where REFPROJET = " . $rr4['id_projet'];
  $q88   = $conn->query($req88);
  $rr5   = $q88->fetch_assoc();
  if ($rr5['projter'] == 100) {
   $pt++;
  }
 }
 $req  = "select p.* from `personne` as p join `client` as c where ((c.`REFPERSONNE`=p.`ID`) AND (p.`ID`=" . $_SESSION['ID_CLIENT'] . "));";
 $res  = $conn->query($req);
 $data = array();
 while ($r = $res->fetch_assoc()) {
  $data[] = $r;
 }
 foreach ($data as $d2) {
  $n = $d2['Nom'];
  $p = $d2['Prenom'];
 }
}
?>
<div id="content">
  <div class="menubar">
    <div class="page-title">
      <strong>Bienvenue <span class="home"><?php echo $n . " " . $p; ?></span></strong>
    </div>
  </div>
  <div class="content-wrapper">
    <div class="metrics clearfix">
      <div class="metric">
        <span class="field">Nombre De Clients</span>
        <span class="data"><i class="fa fa-group"></i><?php echo "<br>" . $a; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Projets Totales</span>
        <span class="data"><i class="fa fa-cubes"></i><?php echo "<br>" . $c; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Projets Demandés</span>
        <span class="data"><i class="fa fa-spinner"></i><?php echo "<br>" . $b; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Projets Terminés</span>
        <span class="data"><i class="fa fa-check"></i><?php echo "<br>" . $pt; ?></span>
      </div>
    </div>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>