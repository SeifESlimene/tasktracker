<?php
$title = "Modification D'un Employé";
include 'init.php';
if (isset($_GET['id_employe'])) {
 if (!empty($_GET['id_employe'])) {
  $id_employe = $_GET['id_employe'];
  $req_c      = "SELECT p.*,MATRICULE,REFPERSONNEE FROM employe as e JOIN personne as p WHERE p.ID = e.REFPERSONNEE AND p.ID=" . $id_employe;
  $res        = $conn->query($req_c);
  while ($r = $res->fetch_assoc()) {
   $nom        = $r['Nom'];
   $prenom     = $r['Prenom'];
   $datenais   = $r['datenaissance'];
   $email      = $r['email'];
   $adresse    = $r['adresse'];
   $cin        = $r['cin'];
   $matriculee = $r['MATRICULE'];
   $idpersonne = $r['REFPERSONNEE'];
  }
  $e = array();
  if (!empty($_POST)) {
   $nom        = $conn->real_escape_string($_POST['Nom']);
   $prenom     = $conn->real_escape_string($_POST['Prenom']);
   $datenais   = $conn->real_escape_string($_POST['datenaissance']);
   $email      = $conn->real_escape_string($_POST['email']);
   $adresse    = $conn->real_escape_string($_POST['adresse']);
   $cin        = $conn->real_escape_string($_POST['cin']);
   $matriculee = $conn->real_escape_string($_POST['matricule']);
   if (empty($nom)) {
    $e["Nom"] = "Le Champ 'Nom' Est Obligatoire";
   }
   if (empty($prenom)) {
    $e["Prenom"] = "Le Champ 'Prénom' Est Obligatoire";
   }
   if (empty($datenais)) {
    $e["datenaissance"] = "Le Champ 'Date De Naissance' Est Obligatoire";
   }
   if (empty($email)) {
    $e["email"] = "Le Champ 'Adresse Email' Est Obligatoire";
   }
   if (empty($adresse)) {
    $e["adresse"] = "Le Champ 'Adresse' Est Obligatoire";
   }
   if (empty($cin)) {
    $e["cin"] = "Le Champ 'Numéro C.I.N' Est Obligatoire";
   }
   if (empty($matriculee)) {
    $e["MATRICULE"] = "Le Champ 'Matricule' Est Obligatoire";
   }
   if (sizeof($e) < 1) {
    $req_update = "UPDATE  `personne` SET Nom='" . $nom . "',Prenom='" . $prenom . "',datenaissance='" . $datenais . "',email='" . $email . "',adresse='" . $adresse . "',cin='" . $cin . "' WHERE ID =" . $idpersonne;
    $conn->query($req_update);
    $req_update_emp = "UPDATE `employe` SET MATRICULE='" . $matriculee . "' WHERE REFPERSONNEE =" . $idpersonne;
    $conn->query($req_update_emp);
    header('location:affichage_employe.php?p=1');
   }
  }
 }
}
?>
<div id="content">
  <div class="menubar">
    <div class="page-title">
      <h3><strong>Modifier Un Employé</strong></h3>
    </div>
  </div>
  <div class="content-wrapper">
    <form id="new-customer" class="form-horizontal" method="post" action="" role="form">
      <div class="form-group <?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Nom</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="Nom" value="<?php echo $nom; ?>" />
          <span class="help-block"><?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo $e['Nom'];}} ?></span>
        </div>
      </div>
      <div class="form-group <?php if (isset($e['Prenom'])) {if (!empty($e['Prenom'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Prénom</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="Prenom" value="<?php echo $prenom; ?>" />
          <span
            class="help-block"><?php if (isset($e['Prenom'])) {if (!empty($e['Prenom'])) {echo $e['Prenom'];}} ?></span>
        </div>
      </div>
      <div
        class="form-group <?php if (isset($e['datenaissance'])) {if (!empty($e['datenaissance'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Date De Naissance</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="datenaissance" value="<?php echo $datenais; ?>" />
          <span
            class="help-block"><?php if (isset($e['datenaissance'])) {if (!empty($e['datenaissance'])) {echo $e['datenaissance'];}} ?></span>
        </div>
      </div>
      <div class="form-group <?php if (isset($e['email'])) {if (!empty($e['email'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Adresse Email</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" />
          <span
            class="help-block"><?php if (isset($e['email'])) {if (!empty($e['email'])) {echo $e['email'];}} ?></span>
        </div>
      </div>
      <div class="form-group <?php if (isset($e['adresse'])) {if (!empty($e['adresse'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Adresse</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="adresse" value="<?php echo $adresse; ?>" />
          <span
            class="help-block"><?php if (isset($e['adresse'])) {if (!empty($e['adresse'])) {echo $e['adresse'];}} ?></span>
        </div>
      </div>
      <div class="form-group <?php if (isset($e['cin'])) {if (!empty($e['cin'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Numéro C.I.N</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="cin" value="<?php echo $cin; ?>" />
          <span class="help-block"><?php if (isset($e['cin'])) {if (!empty($e['cin'])) {echo $e['cin'];}} ?></span>
        </div>
      </div>
      <div class="form-group <?php if (isset($e['MATRICULE'])) {if (!empty($e['MATRICULE'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Matricule</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="matricule" value="<?php echo $matriculee; ?>" />
          <span
            class="help-block"><?php if (isset($e['MATRICULE'])) {if (!empty($e['MATRICULE'])) {echo $e['MATRICULE'];}} ?></span>
        </div>
      </div>
      <div class="form-group form-actions">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <a href="modifier_employe.php?id_employe=<?php echo $id_employe; ?>" class="btn btn-default">Annuler</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>