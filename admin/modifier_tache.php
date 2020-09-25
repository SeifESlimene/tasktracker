<?php
$title = "Modification D'une Tâche";
include 'init.php';
$nom = "";
if (isset($_GET['id_tache'])) {
 if (!empty($_GET['id_tache'])) {
  $id_tache = $_GET['id_tache'];
  $req      = "select * from `tache`as t join `projet` as p where p.`id_projet`= t.`REFPROJET` AND t.ID=" . $id_tache;
  $res      = $conn->query($req);
  while ($r = $res->fetch_assoc()) {
   $n = $r['Nom_Proj'];
   $k = $r['id_projet'];
   $l = $r['Nom'];
  }
  $req_c = "select * from `tache` where ID=" . $id_tache;
  $res   = $conn->query($req_c);
  while ($r = $res->fetch_assoc()) {
   $nom        = $r['Nom'];
   $descriptio = $r['Desc_Tache'];
   $nbrheurs   = $r['Nbr_Heurs'];
  }
  $e = array();
  if (!empty($_POST)) {
   $nom         = $conn->real_escape_string($_POST['Nomm']);
   $description = $conn->real_escape_string($_POST['descriptiontache']);
   $nbrheurs    = $conn->real_escape_string($_POST['nbrheures']);
   if (empty($nom)) {
    $e["Nom"] = "Le Champ 'Nom Du Tâche' Est Obligatoire";
   }
   if (empty($description)) {
    $e["Description"] = "Le Champ 'Description Du Tâche' Est Obligatoire";
   }
   if (empty($nbrheurs)) {
    $e["Nbr_Heurs"] = "Le Champ 'Nombre d'heurs' Est Obligatoire";
   }
   if (sizeof($e) < 1) {
    $req_mo = "UPDATE  `tache` set Nom='" . $nom . "',Desc_Tache='" . $description . "', Nbr_Heurs=" . $nbrheurs . " where ID =" . $id_tache;
    $conn->query($req_mo);
    header('location:affichage_taches.php?id_projet=' . $k . '&p=1');
   }
  }
 } else {
  header('location:affichage_taches.php?id_projet=' . $k . '&p=1');
 }
} else {
 header('location:affichage_taches.php?id_projet=' . $k . '&p=1');
}
?>
<div id="content">
  <div class="menubar f">
    <div class="page-title">
      <h4><strong>Modification Du Tâche &sdot;<span class="colo"><?php echo $l; ?></span>&sdot; Du Projet &sdot;<span
            class="ti1"><?php echo $n; ?><span>&sdot;</strong></h4>
    </div>
  </div>
  <div class="content-wrapper">
    <a href="Affichage_Taches.php?id_projet=<?php echo $k; ?>" class="btn btn-primary">Liste Des Tâches</a>
    <form class="form-horizontal" method="post" action="">
      <div class="form-group <?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Nom Du Tâche</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="Nomm" value="<?php echo $nom; ?>" />
          <span class="help-block"><?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo $e['Nom'];}} ?></span>
        </div>
      </div>
      <div
        class="form-group <?php if (isset($e['Description'])) {if (!empty($e['Description'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Description Du Tâche</label>
        <div class="col-sm-10 col-md-8">
          <textarea class="form-control" rows="4" name="descriptiontache" value=""><?php echo $descriptio; ?></textarea>
          <span
            class="help-block"><?php if (isset($e['Description'])) {if (!empty($e['Description'])) {echo $e['Description'];}} ?></span>
        </div>
      </div>
      <div class="form-group <?php if (isset($e["Nbr_Heurs"])) {if (!empty($e["Nbr_Heurs"])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Nombre d'heures</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="nbrheures" value="<?php echo $nbrheurs; ?>"></textarea>
          <span
            class="help-block"><?php if (isset($e["Nbr_Heurs"])) {if (!empty($e["Nbr_Heurs"])) {echo $e["Nbr_Heurs"];}} ?></span>
        </div>
      </div>
      <div class="form-group form-actions">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <a href="affichage_taches.php?id_projet=<?php echo $k . "&p=1"; ?>" class="btn btn-default">Annuler</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>