<?php
    $title = "Ajout D'un Tâche";
    include 'init.php'
;?>
<?php
    $nom         = '';
    $description = '';
    $nbrheurs    = '';
    if (isset($_GET['id_projet'])) {
        if (!empty($_GET['id_projet'])) {
            $id_projet = $_GET['id_projet'];
            $req       = 'select * from `projet` where id_projet=' . $id_projet . ';';
            $res       = $conn->query($req);
            $data      = array();
            $e         = array();
            while ($r = $res->fetch_assoc()) {
                $data[] = $r;
            }
            foreach ($data as $d) {
                $n = $d['Nom_Proj'];
            }

            if (isset($_POST)) {
                if (!empty($_POST)) {
                    $nom         = $conn->real_escape_string($_POST['Nomm']);
                    $description = $conn->real_escape_string($_POST['descriptiontache']);
                    $nbrheurs    = $conn->real_escape_string($_POST['nbrheures']);
                    if (empty($nom)) {
                        $e['Nom'] = "Le Champ 'Nom Du Tâche' Est Obligatoire";
                    }
                    if (empty($description)) {
                        $e['Description'] = "Le Champ 'Description Du Tâche' Est Obligatoire";
                    }
                    if (empty($nbrheurs)) {
                        $e['Nbr_Heurs'] = "Le Champ 'Nombre d'heures' Est Obligatoire";
                    }
                    if (sizeof($e) < 1) {
                        $nbrheursint = intval($nbrheurs);
                        $req_ajout   = "INSERT INTO tache (Nom, Desc_Tache, REFPROJET , Nbr_Heurs) VALUES   ('" . $nom . "','" . $description . "'," . $d['id_projet'] . ',' . $nbrheursint . ');';
                        $res         = $conn->query($req_ajout);

                        // var_dump($req_ajout);
                        // var_dump($res);
                        // var_dump($nom);
                        // var_dump($description);
                        // var_dump($nbrheursint);
                         header('location:Affichage_Taches.php?id_projet=' . $id_projet . '&p=1');
                    }
                }
            }
        } else {
            header('location:affichage_taches.php');
        }
    } else {
        header('location:affichage_taches.php');
    }
?>
<div id="content">
  <div class="menubar f">
    <div class="page-title">
      <h4><strong>Ajout D'une Tâche Au Projet &sdot;<span class="colo"><?php echo $n; ?></span>&sdot;</strong></h4>
    </div>
  </div>
  <div class="content-wrapper"><a href="Affichage_Taches.php?id_projet=<?php echo $id_projet; ?>"
      class="btn btn-primary">Liste Des Tâches</a></div>
  <form id="new-customer" class="form-horizontal" method="post" action="" role="form">
    <div
      class="form-group                                                                         <?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo 'has-error';}}?>">
      <label class="col-sm-2 col-md-2 control-label">Nom Du Tâche</label>
      <div class="col-sm-10 col-md-8">
        <input type="text" class="form-control" name="Nomm" placeholder="Nom Du Tâche" value="<?php echo $nom; ?>" />
        <span class="help-block"><?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo $e['Nom'];}}?></span>
      </div>
    </div>
    <div
      class="form-group                                                                         <?php if (isset($e['Description'])) {if (!empty($e['Description'])) {echo 'has-error';}}?>">
      <label class="col-sm-2 col-md-2 control-label">Description Du Tâche</label>
      <div class="col-sm-10 col-md-8">
        <textarea class="form-control" rows="4" placeholder="Description Du Tâche"
          name="descriptiontache"><?php echo $description; ?></textarea>
        <span
          class="help-block"><?php if (isset($e['Description'])) {if (!empty($e['Description'])) {echo $e['Description'];}}?></span>
      </div>
    </div>
    <div
      class="form-group                                                                         <?php if (isset($e['Nbr_Heurs'])) {if (!empty($e['Nbr_Heurs'])) {echo 'has-error';}}?>">
      <label class="col-sm-2 col-md-2 control-label">Nombre d'heures</label>
      <div class="col-sm-10 col-md-8">
        <input type="text" class="form-control" name="nbrheures" value="<?php echo $nbrheurs; ?>"></textarea>
        <span
          class="help-block"><?php if (isset($e['Nbr_Heurs'])) {if (!empty($e['Nbr_Heurs'])) {echo $e['Nbr_Heurs'];}}?></span>
      </div>
    </div>
    <div class="form-group form-actions">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="Affichage_Taches.php?id_projet=<?php echo $id_projet; ?>" class="btn btn-default">Annuler</a>
      </div>
    </div>
  </form>
</div>
<?php include $tpl . 'footer.php';?>