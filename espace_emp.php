<?php
$title         = "Espace Employé";
$EmployeNavbar = "";
$BodyAtt       = "id='dashboard'";
include 'init.php';
?>
<?php
if (empty($_SESSION['Email_Emp'])) {
 header('location:login_employe.php');
} else {
 $req = 'select count(*) from client;';
 $q   = $conn->query($req);
 $clt = array();
 while ($r = $q->fetch_assoc()) {
  $clt = $r;
 }
 foreach ($clt as $c) {
  $a = $c;
 }
 $req2 = 'select count(*) from employe;';
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
 $req4 = 'select count(*) from tache;';
 $q4   = $conn->query($req4);
 $clt4 = array();
 while ($r4 = $q4->fetch_assoc()) {
  $clt4 = $r4;
 }
 foreach ($clt4 as $c4) {
  $d = $c4;
 }
 $req_liste_tache = "select p.* from `personne` as p join `employe` as e where ((e.`REFPERSONNEE`=p.`ID`) AND (p.`ID`=" . $_SESSION['ID_EMPLOYE'] . "));";
 $res             = $conn->query($req_liste_tache);
 $data            = array();
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
        <span class="field">Nombre d'employés</span>
        <span class="data"><i class="fa fa-tags"></i><?php echo "<br>" . $b; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Clients</span>
        <span class="data"><i class="fa fa-group"></i><?php echo "<br>" . $a; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Projets</span>
        <span class="data"><i class="fa fa-cubes"></i><?php echo "<br>" . $c; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Tâches</span>
        <span class="data"><i class="fa fa-tasks"></i><?php echo "<br>" . $d; ?></span>
      </div>
    </div>
  </div>
</div>
</div>
<?php include $tpl . "footer.php"; ?>