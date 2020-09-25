<?php
$title = "Lire Informations";
if (isset($_GET['s'])) {
 if ($_GET['s'] == 'cli') {
  $ClientNavbar = "";
 } elseif ($_GET['s'] == 'emp') {
  $EmployeNavbar = "";
 }
}
include 'init.php';
?>


<?php

if ((isset($_GET['id_projet'])) && (!isset($_GET['id_tache']))) {
 if (!empty($_GET['id_projet'])) {
  $reqproj   = "select * from projet where id_projet = " . $_GET['id_projet'];
  $resproj   = $conn->query($reqproj);
  $r         = $resproj->fetch_assoc();
  $Nomproj   = $r['Nom_Proj'];
  $Descproj  = $r['Description_Proj'];
  $refclient = $r['Refclient']; ?>
<div id="content" class="b45">
  <a href="<?php if ((isset($_GET['s'])) and ($_GET['s'] == 'cli')) {echo 'affichage_projet_client.php';} elseif (isset($_GET['s']) and ($_GET['s'] == 'emp')) {echo 'affichage_projet_emp.php';} ?><?php if (isset($_GET['p'])) {echo "?p=" . $_GET['p'];} ?>"
    class="btn btn-primary">Retour</a>
  <hr>
  <!-- Notre Panel -->
  <div class="panel panel-info">
    <!-- Start Panel Heading -->
    <div class="panel-heading">
      <h3 class="panel-title"><b><?php echo $Nomproj; ?></b></h3>
    </div>
    <!-- End Panel Heading -->
    <!-- Start Panel Body -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 col-lg-3 " align="center">
          <span class="fa fa-cubes fa-5x icon"></span>
        </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Nom Projet</b></td>
                <td><?php echo $Nomproj; ?></td>
              </tr>
              <tr>
                <td><b>Description Projet</b></td>
                <td><?php echo $Descproj; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End Panel Body -->
  </div>
  <!-- Fin Du Panel -->
</div>
<?php }} ?>


<?php

if ((isset($_GET['id_projet'])) && (isset($_GET['id_tache']))) {
 if (!empty($_GET['id_tache'])) {
  $reqtache    = "select * from tache where ID = " . $_GET['id_tache'];
  $restache    = $conn->query($reqtache);
  $r           = $restache->fetch_assoc();
  $Nomtache    = $r['Nom'];
  $Desctache   = $r['Desc_Tache'];
  $pourcentage = $r['pourcentage'];
  $nbrheurs    = $r['Nbr_Heurs'];
  $req100      = "select Nom,Prenom from personne where ID=" . $r['REFEMPLOYE'];
  $res100      = $conn->query($req100);
  $rr          = $res100->fetch_assoc();
  $np          = $rr['Nom'] . " " . $rr['Prenom'];
  $req101      = "select Nom_Proj from projet where id_projet=" . $r['REFPROJET'];
  $res101      = $conn->query($req101);
  $rr1         = $res101->fetch_assoc();
  $npr         = $rr1['Nom_Proj'];
  ?>
<div id="content" class="b45">
  <a href="<?php if (isset($_GET['s']) and ($_GET['s'] == 'emp')) {echo 'affichage_taches_emp.php?id_projet=' . $_GET['id_projet'];} ?>"
    class="btn btn-primary">Retour</a>
  <hr>
  <!-- Notre Panel -->
  <div class="panel panel-info">
    <!-- Start Panel Heading -->
    <div class="panel-heading">
      <h3 class="panel-title"><b><?php echo $Nomtache; ?></b></h3>
    </div>
    <!-- End Panel Heading -->
    <!-- Start Panel Body -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 col-lg-3 " align="center">
          <span class="fa fa-wpforms fa-5x icon"></span>
        </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Nom Projet</b></td>
                <td><?php echo $Nomtache; ?></td>
              </tr>
              <tr>
                <td><b>Pourcentage</b></td>
                <td><?php echo $pourcentage . "%"; ?></td>
              </tr>
              <tr>
                <td><b>Nombre D'heures</b></td>
                <td><?php echo $nbrheurs; ?></td>
              </tr>
              <tr>
                <td><b>Employé En Charge</b></td>
                <td><?php echo $np; ?><br>
              </tr>
              <tr>
                <td><b>Appartient Au Projet</b></td>
                <td><?php echo $npr; ?></td>
              </tr>
              <tr>
                <td><b>Description Du Tâche</b></td>
                <td><?php echo $Desctache; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End Panel Body -->
  </div>
  <!-- Fin Du Panel -->
</div>
<?php }} ?>








<?php

if ((isset($_GET['message'])) && (($_GET['f'] == 'message_envoyés') || ($_GET['f'] == 'message_reçus'))) {
 if (!empty($_GET['message'])) {
  $reqtache     = "select * from contact tache where ID = " . $_GET['message'];
  $restache     = $conn->query($reqtache);
  $r            = $restache->fetch_assoc();
  $Emetteur     = $r['Emeteur'];
  $Destinataire = $r['Destinataire'];
  $Date         = $r['Date'];
  $Objet        = $r['objet'];
  $Message      = $r['message'];
  ?>
<div id="content" class="sae">
  <?php if ($_GET['s'] == 'cli') { ?><a
    href="contact_client.php<?php if (($_GET['f']) == 'message_reçus') {echo '?f=message_reçus&p=' . $_GET['p'];} elseif ($_GET['f'] == 'message_envoyés') {echo '?f=message_envoyés&p=' . $_GET['p'];} ?>"
    class="btn btn-primary">Retour</a><?php } ?>
  <?php if ($_GET['s'] == 'emp') { ?><a
    href="contact_emp.php<?php if (($_GET['f']) == 'message_reçus') {echo '?f=message_reçus&p=' . $_GET['p'];} elseif ($_GET['f'] == 'message_envoyés') {echo '?f=message_envoyés&p=' . $_GET['p'];} ?>"
    class="btn btn-primary">Retour</a><?php } ?>
  <hr>
  <!-- Notre Panel -->
  <div class="panel panel-info">
    <!-- Start Panel Heading -->
    <div class="panel-heading">
      <h3 class="panel-title"><b></b></h3>
    </div>
    <!-- End Panel Heading -->
    <!-- Start Panel Body -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 col-lg-3 " align="center">
          <i class="glyphicon glyphicon-envelope" width="250" height="250"></i>
        </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Date</b></td>
                <td><?php echo substr($r['Date'], 0, 10); ?></td>
              </tr>
              <tr>
              <tr>
                <td><b>Heure</b></td>
                <td><?php echo substr($r['Date'], 11, 5); ?></td>
              </tr>
              <td><b>Objet Du Message</b></td>
              <td><?php echo $Objet; ?><br>
                </tr>
                <tr>
                  <td><b>Message</b></td>
                  <td><?php echo $Message; ?></td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End Panel Body -->
  </div>
  <!-- Fin Du Panel -->
</div>
<?php }} ?>












<?php include $tpl . "footer.php"; ?>