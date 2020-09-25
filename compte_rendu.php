<?php
$title         = "Compte Rendu";
$EmployeNavbar = "";
include 'init.php';
?>
<?php
if (isset($_GET['id_tache'])) {
 if (!empty($_GET['id_tache'])) {
  $req  = "select * from tache where ID=" . $_GET['id_tache'];
  $res1 = $conn->query($req);
  $bb   = 0;
  if (isset($_POST['texte'])) {
   if (!empty($_POST['texte'])) {
    $texte    = $_POST['texte'];
    $id_tache = $_GET['id_tache'];
    $rcc      = "INSERT into compte_rendu (texte,REFEMPLOYE,REFTACHE) values ('" . $texte . "'," . $_SESSION['ID_EMPLOYE'] . "," . $_GET['id_tache'] . ")";
    $res      = $conn->query($rcc);
    $bb++;
    header('location:affichage_taches_emp.php?id_projet=' . $_GET['id_projet']);
   }
  }
 }
}
?>
<div id="content" class="cadc hf">
  <a href="<?php echo 'affichage_taches_emp.php?id_projet=' . $_GET['id_projet']; ?>" class="btn btn-primary">Retour</a>
  <hr>
  <div class="menubar">
    <div class="page-title">
      <strong>Compte Rendu Du Tâche <span
          class="colo"><?php $r = $res1->fetch_assoc();
echo $r['Nom']; ?></span></strong>
    </div>
  </div>
  <div class="row content-row bt">
    <div class="col-lg-8 col-lg-offset-2">







      <form name="sentMessage" method="post" action="" enctype="multipart/form-data" id="form">
        <?php
if ($bb == 1) { ?>
        <div class='alert alert-success'>Compte Rendu Envoyé Avec Succés!</div>
        <?php } ?>
        <div
          class="form-group col-xs-12 floating-label-form-group controls <?php if (isset($e['texte'])) {if (!empty($e['texte'])) {echo 'has-error';}} ?>">
          <label>Votre Compte Rendu</label>
          <textarea rows="10" class="form-control" id="texte" name="texte"></textarea>
          <p class="help-block text-danger"><?php if (isset($e['texte'])) {echo $e['texte'];} ?></p>
        </div>
        <div class="row">
          <div class="form-group col-xs-12">
            <button type="submit" class="btn btn-outline-dark">Envoyer</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<?php include $tpl . "footer.php"; ?>