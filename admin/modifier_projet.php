<?php
$title = "Modification D'un Projet";
include 'init.php';
if (isset($_GET['id_projet'])) {
 if (!empty($_GET['id_projet'])) {
  $id_projet = $_GET['id_projet'];
  $req_c     = "select * from projet where id_projet=" . $id_projet;
  $res       = $conn->query($req_c);
  while ($r = $res->fetch_assoc()) {
   $nom        = $r['Nom_Proj'];
   $descriptio = $r['Description_Proj'];
  }
  $e = array();
  if (!empty($_POST)) {
   $nom         = $conn->real_escape_string($_POST['Nom']);
   $description = $conn->real_escape_string($_POST['Descriptionn']);
   if (empty($nom)) {
    $e["Nom_Proj"] = "Le Champ 'Nom Du Projet' Est Obligatoire";
   }
   if (empty($description)) {
    $e["Description_Proj"] = "Le Champ 'Description Du Projet' Est Obligatoire";
   }
   if (sizeof($e) < 1) {
    $req_update = "UPDATE  `projet` set Nom_Proj='" . $nom . "',Description_Proj='" . $description . "' where id_projet =" . $id_projet;
    $conn->query($req_update);
    header('location:Affichage_Projet.php?p=1');
   }
  }
 } else {
  header('location:modifier_projet.php?p=1');
 }
} else {
 header('location:modifier_projet.php?p=1');
}
?>
<div id="content">
  <div class="menubar">
    <div class="page-title">
      <h3><strong>Modifier Un Projet</strong></h3>
    </div>
  </div>
  <div class="content-wrapper">
    <form class="form-horizontal" method="post" action="">
      <div class="form-group <?php if (isset($e['Nom_Proj'])) {if (!empty($e['Nom_Proj'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Nom Du Projet</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="Nom" value="<?php echo $nom; ?>" />
          <span
            class="help-block"><?php if (isset($e['Nom_Proj'])) {if (!empty($e['Nom_Proj'])) {echo $e['Nom_Proj'];}} ?></span>
        </div>
      </div>
      <div
        class="form-group <?php if (isset($e['Description_Proj'])) {if (!empty($e['Description_Proj'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Description Du Projet</label>
        <div class="col-sm-10 col-md-8">
          <textarea class="form-control" rows="6" name="Descriptionn" value=""><?php echo $descriptio; ?></textarea>
          <span
            class="help-block"><?php if (isset($e['Description_Proj'])) {if (!empty($e['Description_Proj'])) {echo $e['Description_Proj'];}} ?></span>
        </div>
      </div>
      <div class="form-group form-actions">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Enregistrer Le Projet</button>
          <a href="affichage_projet.php?p=1" class="btn btn-default">Annuler</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>