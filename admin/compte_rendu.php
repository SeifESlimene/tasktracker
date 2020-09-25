<?php
$title = "Lire Informations";
include 'init.php';
?>




<?php

if (isset($_GET['idcompterendu'])) {
 if (!empty($_GET['idcompterendu'])) {
  $reqcr    = "select * from compte_rendu where ID_compterendu = " . $_GET['idcompterendu'];
  $rescr    = $conn->query($reqcr);
  $r        = $rescr->fetch_assoc();
  $texte    = $r['texte'];
  $reqCli   = "SELECT * from personne where ID = " . $r['REFEMPLOYE'];
  $resCli   = $conn->query($reqCli);
  $r1       = $resCli->fetch_assoc();
  $reqtache = "select * from tache join projet where (projet.id_projet=tache.REFPROJET) and ID = " . $r['REFTACHE'];
  $restache = $conn->query($reqtache);
  $r2       = $restache->fetch_assoc();
  ?>
<div id="content" class="b45">
  <a href="<?php echo 'Avancement.php'; ?>" class="btn btn-primary">Retour</a>
  <hr>
  <!-- Notre Panel -->
  <div class="panel panel-info">
    <!-- Start Panel Heading -->
    <div class="panel-heading">
      <h3 class="panel-title"><b>Compte Rendu</b></h3>
    </div>
    <!-- End Panel Heading -->
    <!-- Start Panel Body -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 col-lg-3 " align="center">
          <span class="fa fa-pencil-square-o fa-5x icon"></span>
        </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Employé</b></td>
                <td>
                  <?php echo $r1['Nom'] . " " . $r1['Prenom']; ?>
                </td>
              </tr>
              <tr>
                <td><b>Tâche</b></td>
                <td><?php echo $r2['Nom']; ?></td>
              </tr>
              <tr>
                <td><b>Projet</b></td>
                <td><?php echo $r2['Nom_Proj']; ?></td>
              </tr>
              <tr>
                <td><b>Description</b></td>
                <td><?php echo $r['texte']; ?></td>
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
        <a href="validation.php?idtacheval=<?php echo $r2['ID']; ?>" type="button" class="btn btn-sm btn-success">
          Valider
        </a>
        <a href="validation.php?idtachepasval=<?php echo $r2['ID']; ?>" type="button" class="btn btn-sm btn-danger">
          Pas Valider
        </a>
      </span>
    </div>
    <!-- End Panel Footer -->
  </div>
  <!-- Fin Du Panel -->
</div>
<?php }} ?>






<?php include $tpl . "footer.php"; ?>