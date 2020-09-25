<?php
$title = "Lire Informations";
include 'init.php';
?>

<?php if (isset($_GET['id_client'])) {
 if (!empty($_GET['id_client'])) {
  $reqCli = "SELECT * from client join personne where (client.REFPERSONNE = personne.ID)";
  $resCli = $conn->query($reqCli);
  $r      = $resCli->fetch_assoc();
  $Nom    = $r['Nom'];
  $Prenom = $r['Prenom'];
  ?>
<div id="content" class="sae">
  <a href="Affichage_Client.php<?php if (isset($_GET['p'])) {echo "?p=" . $_GET['p'];} ?>"
    class="btn btn-primary">Retour</a>
  <hr>
  <!-- Notre Panel -->
  <div class="panel panel-info">
    <!-- Start Panel Heading -->
    <div class="panel-heading">
      <h3 class="panel-title"><b><?php echo $Nom . " " . $Prenom; ?></b></h3>
    </div>
    <!-- End Panel Heading -->
    <!-- Start Panel Body -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 col-lg-3 " align="center">
          <?php if ($r['image'] == 'Client') {echo "<img src='../" . $images . "/Client.png' width='250px' height='250px' class= 'img-circle img-responsive' />";} elseif ($r['image'] == 'Employé') {echo "<img src='../" . $images . "/Employe.png' width='250px' height='250px' class= 'img-circle img-responsive'/>";} else {echo "<img src='../Data/Uploads/" . $r['image'] . "' width='250px' height='250px' class= 'img-circle img-responsive'/>";} ?>
        </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Nom</b></td>
                <td><?php echo $r['Nom']; ?></td>
              </tr>
              <tr>
                <td><b>Prénom</b></td>
                <td><?php echo $r['Prenom']; ?></td>
              </tr>
              <tr>
                <td><b>Date Du Naissance</b></td>
                <td><?php echo $r['datenaissance']; ?></td>
              </tr>
              <tr>
                <td><b>Adresse Email</b></td>
                <td><?php echo $r['email']; ?><br>
              </tr>
              <tr>
                <td><b>Adresse</b></td>
                <td><?php echo $r['adresse']; ?></td>
              </tr>
              <tr>
                <td><b>Numéro C.I.N</b></td>
                <td><?php echo $r['cin']; ?></td>
              </tr>
              <tr>
                <td><b>Matricule Fiscale</b></td>
                <td><?php echo $r['MATRICULEFISCALE']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End Panel Body -->
    <!-- Start Panel Footer -->
    <div class="panel-footer">
      <a href="contact_admin.php?id_client=<?php echo $_GET['id_client']; ?>" type="button"
        class="btn btn-sm btn-primary">
        <i class="glyphicon glyphicon-envelope"></i>
      </a>
      <span class="pull-right">
        <a href="modifier_client.php?id_client=<?php echo $_GET['id_client']; ?>" type="button"
          class="btn btn-sm btn-warning">
          <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="supprimer.php?id_client=<?php echo $_GET['id_client']; ?>" type="button" class="btn btn-sm btn-danger">
          <i class="glyphicon glyphicon-remove"></i>
        </a>
      </span>
    </div>
    <!-- End Panel Footer -->
  </div>
  <!-- Fin Du Panel -->
</div>
<?php }} ?>



<?php

if (isset($_GET['id_employe'])) {
 if (!empty($_GET['id_employe'])) {
  $reqEmp = "select * from personne join employe where (employe.REFPERSONNEE = personne.ID) and (employe.REFPERSONNEE = " . $_GET['id_employe'] . ")";
  $resEmp = $conn->query($reqEmp);
  $r      = $resEmp->fetch_assoc();
  $Nom    = $r['Nom'];
  $Prenom = $r['Prenom'];
  ?>
<div id="content" class="sae">
  <a href="affichage_employe.php<?php if (isset($_GET['p'])) {echo "?p=" . $_GET['p'];} ?>"
    class="btn btn-primary">Retour</a>
  <hr>
  <!-- Notre Panel -->
  <div class="panel panel-info">
    <!-- Start Panel Heading -->
    <div class="panel-heading">
      <h3 class="panel-title"><b><?php echo $Nom . " " . $Prenom; ?></b></h3>
    </div>
    <!-- End Panel Heading -->
    <!-- Start Panel Body -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 col-lg-3 " align="center">
          <?php if ($r['image'] == 'Client') {echo "<img src='../" . $images . "/Client.png' width='250px' height='250px' class= 'img-circle img-responsive' />";} elseif ($r['image'] == 'Employé') {echo "<img src='../" . $images . "/Employe.png' width='250px' height='250px' class= 'img-circle img-responsive'/>";} else {echo "<img src='../Data/Uploads/" . $r['image'] . "' width='250px' height='250px' class= 'img-circle img-responsive'/>";} ?>
        </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Nom</b></td>
                <td><?php echo $r['Nom']; ?></td>
              </tr>
              <tr>
                <td><b>Prénom</b></td>
                <td><?php echo $r['Prenom']; ?></td>
              </tr>
              <tr>
                <td><b>Date Du Naissance</b></td>
                <td><?php echo $r['datenaissance']; ?></td>
              </tr>
              <tr>
                <td><b>Adresse Email</b></td>
                <td><?php echo $r['email']; ?><br>
              </tr>
              <tr>
                <td><b>Adresse</b></td>
                <td><?php echo $r['adresse']; ?></td>
              </tr>
              <tr>
                <td><b>Numéro C.I.N</b></td>
                <td><?php echo $r['cin']; ?></td>
              </tr>
              <tr>
                <td><b>Matricule Fiscale</b></td>
                <td><?php echo $r['MATRICULE']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End Panel Body -->
    <!-- Start Panel Footer -->
    <div class="panel-footer">
      <a href="contact_admin.php?id_employe=<?php echo $_GET['id_employe']; ?>" type="button"
        class="btn btn-sm btn-primary">
        <i class="glyphicon glyphicon-envelope"></i>
      </a>
      <span class="pull-right">
        <a href="modifier_employe.php?id_employe=<?php echo $_GET['id_employe']; ?>" type="button"
          class="btn btn-sm btn-warning">
          <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="supprimer.php?id_employe=<?php echo $_GET['id_employe']; ?>" type="button"
          class="btn btn-sm btn-danger">
          <i class="glyphicon glyphicon-remove"></i>
        </a>
      </span>
    </div>
    <!-- End Panel Footer -->
  </div>
  <!-- Fin Du Panel -->
</div>
<?php }} ?>



<?php

if ((isset($_GET['id_projet'])) && (!isset($_GET['id_tache']))) {
 if (!empty($_GET['id_projet'])) {
  $reqproj   = "select * from projet where id_projet = " . $_GET['id_projet'];
  $resproj   = $conn->query($reqproj);
  $r         = $resproj->fetch_assoc();
  $Nomproj   = $r['Nom_Proj'];
  $Descproj  = $r['Description_Proj'];
  $refclient = $r['Refclient'];
  ?>
<div id="content" class="sae">
  <a href="affichage_projet.php<?php if (isset($_GET['p'])) {echo "?p=" . $_GET['p'];} ?>"
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
                <td><b>Client Demandeur</b></td>
                <td>
                  <?php

  $req100 = "select Nom,Prenom from personne where ID=" . $refclient;
  $res100 = $conn->query($req100);
  $rr     = $res100->fetch_assoc();
  $np     = $rr['Nom'] . " " . $rr['Prenom'];
  echo $rr['Nom'] . " " . $rr['Prenom']; ?>
                </td>
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
    <!-- Start Panel Footer -->
    <div class="panel-footer">
      <a href="affichage_taches.php?id_projet=<?php echo $_GET['id_projet'] ?> &p=1"   type="button"
        class="btn btn-sm btn-primary">
        <i class="fa fa-tasks"></i>
      </a>
      <span class="pull-right">
        <a href="modifier_projet.php?id_projet=<?php echo $_GET['id_projet']; ?>" type="button"
          class="btn btn-sm btn-warning">
          <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="supprimer.php?id_projet=<?php echo $_GET['id_projet']; ?>" type="button" class="btn btn-sm btn-danger">
          <i class="glyphicon glyphicon-remove"></i>
        </a>
      </span>
    </div>
    <!-- End Panel Footer -->
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
  $req102      = "select count(*) as neec from tache where ID=" . $_GET['id_tache'] . " and REFEMPLOYE=0";
  $res102      = $conn->query($req102);
  $rr5         = $res102->fetch_assoc();
  $np          = $rr['Nom'] . " " . $rr['Prenom'];
  $req101      = "select Nom_Proj from projet where id_projet=" . $r['REFPROJET'];
  $res101      = $conn->query($req101);
  $rr1         = $res101->fetch_assoc();
  $npr         = $rr1['Nom_Proj'];
  ?>
<div id="content" class="sae">
  <a href="affichage_taches.php<?php if (isset($_GET['p'])) {echo "?id_projet=" . $_GET['id_projet'] . "&p=" . $_GET['p'];} ?>"
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
                <td><?php if ($rr5['neec'] != 0) {echo 'Pas Encore';} else { $np;} ?><br>
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
    <!-- Start Panel Footer -->
    <div class="panel-footer noleft">
      <span class="pull-right">
        <a href="modifier_tache.php?id_tache=<?php echo $_GET['id_tache']; ?>" type="button"
          class="btn btn-sm btn-warning">
          <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="supprimer.php?id_tache=<?php echo $_GET['id_tache']; ?>" type="button" class="btn btn-sm btn-danger">
          <i class="glyphicon glyphicon-remove"></i>
        </a>
      </span>
    </div>
    <!-- End Panel Footer -->
  </div>
  <!-- Fin Du Panel -->
</div>
<?php }} ?>














<?php

if (isset($_GET['message'])) {
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
  <a href="contact_admin.php<?php if (isset($_GET['mesrecus'])) {echo '?mesrecus&p=' . $_GET['p'];} elseif (isset($_GET['mesenv'])) {echo '?mesenv&p1=' . $_GET['p1'];} ?>"
    class="btn btn-primary">Retour</a>
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
                <td><b>Emetteur</b></td>
                <td><?php echo $Emetteur; ?></td>
              </tr>
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