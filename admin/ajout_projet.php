<?php
    $title = "Ajout D'un Projet";
    include 'init.php'
;?>
<?php
    $req_cli     = 'SELECT * FROM personne JOIN client WHERE client.REFPERSONNE = personne.ID';
    $res2        = $conn->query($req_cli);
    $nomp        = '';
    $description = '';
    $e           = array();
    if (isset($_POST)) {
        if (!empty($_POST)) {
            $nomp        = $conn->real_escape_string($_POST['nomprojet']);
            $description = $conn->real_escape_string($_POST['descriptionprojet']);
            $client      = $conn->real_escape_string($_POST['client']);
            if (empty($nomp)) {
                $e['Nom_Pro'] = "Le Champ 'Nom Du Projet' Du Projet Est Obligatoire";
            }
            if (empty($description)) {
                $e['Description_Proj'] = "Le Champ 'Description Du Projet' Du Projet Est Obligatoire";
            }
            if (empty($client) || $client == '--Choisir--') {
                $e['Client'] = "Le Champ 'Client Demandeur' Est Obligatoire";
            }
            if (sizeof($e) < 1) {
                $r         = array();
                $r         = preg_split('/\s+/', $client);
                $refclient = intval($r[3]);
                $req_ajout = "insert into projet (Nom_Proj, Description_Proj , Refclient) VALUES   ('" . $nomp . "','" . $description . "'," . $refclient . ');';
                $conn->query($req_ajout);
                 header('location:affichage_projet.php?p=1');
                // var_dump($_POST);
            }
        }
    }
?>
<div id="content">
  <div class="menubar">
    <div class="page-title">
      <h3><strong>Ajout D'un Projet</strong></h3>
    </div>
  </div>
  <div class="content-wrapper">
    <div class="content-wrapper"><a href="Affichage_Projet.php?p=1" class="btn btn-primary">Liste Des Projets</a></div>
    <form id="new-customer" class="form-horizontal" method="post" action="" role="form">
      <div class="form-group                             <?php if (isset($e['Nom_Pro'])) {if (!empty($e['Nom_Pro'])) {echo 'has-error';}}?>">
        <label class="col-sm-2 col-md-2 control-label">Nom Du Projet</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" placeholder="Nom Du Projet" name="nomprojet"
            value="<?php echo $nomp; ?>" />
          <span
            class="help-block"><?php if (isset($e['Nom_Pro'])) {if (!empty($e['Nom_Pro'])) {echo $e['Nom_Pro'];}}?></span>
        </div>
      </div>
      <div class="form-group                             <?php if (isset($e['Client'])) {if (!empty($e['Client'])) {echo 'has-error';}}?>">
        <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">Client Demandeur</label>
        <div class="col-sm-10 col-md-8">
          <select class="form-control" name="client">
            <option class="active"><?php echo '--Choisir--'; ?></option>
            <?php while ($r1 = $res2->fetch_assoc()) {echo '<option>[ ID = ' . $r1['ID'] . ' ]&nbsp;&nbsp;&nbsp;&nbsp;' . $r1['Nom'] . ' ' . $r1['Prenom'] . '</option>';}?>
          </select>
          <span
            class="help-block"><?php if (isset($e['Client'])) {if (!empty($e['Client'])) {echo $e['Client'];}}?></span>
        </div>
      </div>
      <div
        class="form-group                          <?php if (isset($e['Description_Proj'])) {if (!empty($e['Description_Proj'])) {echo 'has-error';}}?>">
        <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">Description Du Projet</label>
        <div class="col-sm-10 col-md-8">
          <textarea class="form-control" rows="10" placeholder="Description Du Projet ..."
            name="descriptionprojet"><?php echo $description; ?></textarea>
          <span
            class="help-block"><?php if (isset($e['Description_Proj'])) {if (!empty($e['Description_Proj'])) {echo $e['Description_Proj'];}}?></span>
        </div>
      </div>
      <div class="form-group form-actions">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Enregistrer Le Projet</button>
          <a href="Ajout_Projet.php" class="btn btn-default">Annuler</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include $tpl . 'footer.php';?>