<?php
$title = "Modification D'un Client";
include 'init.php'
; ?>
<?php
if (isset($_GET['id_client'])) {
 if (!empty($_GET['id_client'])) {
  $id_client = $_GET['id_client'];
  $req_c     = "select p.*,MATRICULEFISCALE,REFPERSONNE from client as c JOIN personne as p where p.ID = c.REFPERSONNE AND c.id_client=" . $id_client . ";";
  $res       = $conn->query($req_c);
  $clt       = array();
  while ($r = $res->fetch_assoc()) {
   $clt = $r;
  }
  $nom             = $clt['Nom'];
  $prenom          = $clt['Prenom'];
  $datenais        = $clt['datenaissance'];
  $email           = $clt['email'];
  $adresse         = $clt['adresse'];
  $cin             = $clt['cin'];
  $matriculefiscal = $clt['MATRICULEFISCALE'];
  $idpersonne      = $clt['REFPERSONNE'];
  $e               = array();
  if (isset($_POST)) {
   if (!empty($_POST)) {
    $nom             = $conn->real_escape_string($_POST['Nom']);
    $prenom          = $conn->real_escape_string($_POST['Prenom']);
    $datenais        = $conn->real_escape_string($_POST['datenaissance']);
    $email           = $conn->real_escape_string($_POST['email']);
    $adresse         = $conn->real_escape_string($_POST['adresse']);
    $cin             = $conn->real_escape_string($_POST['cin']);
    $matriculefiscal = $conn->real_escape_string($_POST['matriculefiscale']);
    if (empty($nom)) {
     $e["Nom"] = "Le Champ 'Nom' Est Obligatoire";
    }
    if (empty($prenom)) {
     $e["Prenom"] = "Le Champ 'Pr&eacute;nom' Est Obligatoire";
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
     $e["cin"] = "Le Champ 'Num&eacute;ro C.I.N' Est Obligatoire";
    }
    if (empty($matriculefiscal)) {
     $e["MATRICULEFISCALE"] = "Le Champ 'Matricule Fiscale' Est Obligatoire";
    }
    if (sizeof($e) < 1) {
     $req_update = "UPDATE  `personne` set Nom='" . $nom . "',Prenom='" . $prenom . "',datenaissance='" . $datenais . "',email='" . $email . "',adresse='" . $adresse . "',cin='" . $cin . "' where ID =" . $idpersonne . ";";
     $conn->query($req_update);
     $req_update_cli = "UPDATE `client` set MATRICULEFISCALE='" . $matriculefiscal . "' where REFPERSONNE =" . $idpersonne . ";";
     $conn->query($req_update_cli);
     header('location:affichage_client.php?p=1');
    }
   }
  }
 } else {
  header('location:affichage_client.php?p=1');
 }
} else {
 header('location:affichage_client.php?p=1');
}
?>
<div id="content">
  <div class="menubar">
    <div class="page-title">
      <h3><strong>Modifier Un Client</strong></h3>
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
        <label class="col-sm-2 col-md-2 control-label">Pr&eacute;nom</label>
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
        <label class="col-sm-2 col-md-2 control-label">Num&eacute;ro C.I.N</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="cin" value="<?php echo $cin; ?>" />
          <span class="help-block"><?php if (isset($e['cin'])) {if (!empty($e['cin'])) {echo $e['cin'];}} ?></span>
        </div>
      </div>
      <div
        class="form-group <?php if (isset($e['MATRICULEFISCALE'])) {if (!empty($e['MATRICULEFISCALE'])) {echo 'has-error';}} ?>">
        <label class="col-sm-2 col-md-2 control-label">Matricule Fiscale</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="matriculefiscale" value="<?php echo $matriculefiscal; ?>" />
          <span
            class="help-block"><?php if (isset($e['MATRICULEFISCALE'])) {if (!empty($e['MATRICULEFISCALE'])) {echo $e['MATRICULEFISCALE'];}} ?></span>
        </div>
      </div>
      <div class="form-group form-actions">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <a href="affichage_client.php?p=1" class="btn btn-default">Annuler</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>