<?php
    $title   = "Ajout D'un Employé";
    $BodyAtt = '';
    include 'init.php'
;?>
<?php
    $nom             = '';
    $prenom          = '';
    $datenais        = '';
    $email           = '';
    $adresse         = '';
    $cin             = '';
    $matriculefiscal = '';
    $e               = array();
    $v               = 0;
    if (!empty($_POST)) {
        $nom             = $conn->real_escape_string($_POST['Nom']);
        $prenom          = $conn->real_escape_string($_POST['Prenom']);
        $datenais        = $conn->real_escape_string($_POST['datenaissance']);
        $email           = $conn->real_escape_string($_POST['email']);
        $adresse         = $conn->real_escape_string($_POST['adresse']);
        $cin             = $conn->real_escape_string($_POST['cin']);
        $matriculefiscal = $conn->real_escape_string($_POST['matriculefiscale']);
        if (empty($nom)) {
            $e['Nom'] = "Le Champ 'Nom' Est Obligatoire";
        } else {
            if (!preg_match("/^\D{1,15}$/", $nom)) {
                $e['pasvalidenom'] = 'Un Nom Doit Contenir Seulement Des Alphabets Et Du 1 à 15 Chiffres Au Max!';
            } else {
                $e['g'] = '';
                $v++;
            }
        }
        if (empty($prenom)) {
            $e['Prenom'] = "Le Champ 'Prénom' Est Obligatoire";
        } else {
            if (!preg_match("/^\D{1,15}$/", $prenom)) {
                $e['pasvalideprenom'] = 'Un Prénom Doit Contenir Seulement Des Alphabets Et Du 1 à 15 Chiffres Au Max!';
            } else {
                $e['h'] = '';
                $v++;
            }
        }
        if (empty($datenais)) {
            $e['datenaissance'] = "Le Champ 'Date De Naissance' Est Obligatoire";
        } else {
            if (!preg_match("/^(((((1[26]|2[048])00)|[12]\d([2468][048]|[13579][26]|0[48]))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|[12]\d))))|((([12]\d([02468][1235679]|[13579][01345789]))|((1[1345789]|2[1235679])00))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|1\d|2[0-8])))))$/", $datenais)) {
                $e['pasvalide'] = 'Respectez Le Format Du Date!';
            } else {
                $e['i'] = '';
                $v++;
            }
        }
        if (empty($email)) {
            $e['email'] = "Le Champ 'Adresse Email' Est Obligatoire";
        } else {
            if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/", $email)) {
                $e['pasvemail'] = "Respectez Le Format De L'email!";
            } else {
                $e['j'] = '';
                $v++;
            }
        }
        if (empty($adresse)) {
            $e['adresse'] = "Le Champ 'Adresse' Est Obligatoire";
        } else {
            if (!preg_match('/^.{5,30}$/', $adresse)) {
                $e['pasvalideadresse'] = 'Une Adresse Doit Contenir Seulement Des Alphabets Et Du 5 à 30 Chiffres Au Max!';
            } else {
                $e['k'] = '';
                $v++;
            }
        }
        if (empty($cin)) {
            $e['cin'] = "Le Champ 'Numéro C.I.N' Est Obligatoire";
        } else {
            if (!(is_numeric($cin)) || (strlen($cin) != 8)) {
                $e['isnum'] = "Le Champ 'Numéro C.I.N' Doit être Un Chiffre De 8";
            } else {
                $e['l'] = '';
                $v++;
            }
        }
        if (empty($matriculefiscal)) {
            $e['MATRICULEFISCALE'] = "Le Champ 'Matricule Fiscale' Est Obligatoire";
        } else {
            if (!preg_match("/^\d{6}\/[A-Z]\/[A-Z]\/[A-Z]\/\d{3}$/", $matriculefiscal)) {
                $e['pasvalideimm'] = "Respectez Le Format Du L'immatricule!";
            } else {
                $e['m'] = '';
                $v++;
            }
        }
        if ($v == 7) {
            $req_ajout = "INSERT INTO `personne` (`Nom`, `Prenom`, `datenaissance`, `email`, `mdp`, `adresse`, `cin`, `image`) VALUES ('" . $nom . "', '" . $prenom . "', '" . $datenais . "', '" . $email . "', '" . $cin . "', '" . $adresse . "', " . $cin . ", 'Employé');";
            $conn->query($req_ajout);
            $ref_personne  = $conn->insert_id;
            $req_ajout_emp = "INSERT INTO `employe` (`MATRICULE`, `REFPERSONNEE`) VALUES ('" . $matriculefiscal . "', " . $ref_personne . ');';
            $conn->query($req_ajout_emp);
            header('location:Affichage_Employe.php?p=1');
        }
    }
?>

<div id="content">
  <div class="menubar">
    <div class="page-title">
      <h3><strong>Ajout D'un Employé</strong></h3>
    </div>
  </div>
  <div class="content-wrapper">
    <div class="page-title">
      <a href="affichage_employe.php?p=1" class="btn btn-primary">Liste Des Employés</a>
    </div>
    <form class="form-horizontal" method="post" action="">
      <div
        class="form-group                          <?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo 'has-error';}} elseif (isset($e['pasvalidenom'])) {echo 'has-error';}?><?php if (isset($e['g'])) {echo 'has-success';}?>">
        <label class="col-sm-2 col-md-2 control-label">Nom</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="Nom" value="<?php echo $nom; ?>" placeholder="Ex: Slimene" />
          <span
            class="help-block"><?php if (isset($e['Nom'])) {if (!empty($e['Nom'])) {echo $e['Nom'];}} elseif (isset($e['pasvalidenom'])) {echo $e['pasvalidenom'];}?></span>
        </div>
      </div>
      <div
        class="form-group                          <?php if (isset($e['Prenom'])) {if (!empty($e['Prenom'])) {echo 'has-error';}} elseif (isset($e['pasvalideprenom'])) {echo 'has-error';}?><?php if (isset($e['h'])) {echo 'has-success';}?>">
        <label class="col-sm-2 col-md-2 control-label">Prénom</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="Prenom" value="<?php echo $prenom; ?>"
            placeholder="Ex: Seif Eddine" />
          <span
            class="help-block"><?php if (isset($e['Prenom'])) {if (!empty($e['Prenom'])) {echo $e['Prenom'];}} elseif (isset($e['pasvalideprenom'])) {echo $e['pasvalideprenom'];}?></span>
        </div>
      </div>
      <div
        class="form-group                          <?php if (isset($e['datenaissance'])) {if (!empty($e['datenaissance'])) {echo 'has-error';}} elseif (isset($e['pasvalide'])) {echo 'has-error';}?><?php if (isset($e['i'])) {echo 'has-success';}?>">
        <label class="col-sm-2 col-md-2 control-label">Date De Naissance</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="datenaissance" value="<?php echo $datenais; ?>"
            placeholder="Ex: 1999-12-31" />
          <span
            class="help-block"><?php if (isset($e['datenaissance'])) {if (!empty($e['datenaissance'])) {echo $e['datenaissance'];}} elseif (isset($e['pasvalide'])) {echo $e['pasvalide'];}?></span>
        </div>
      </div>
      <div
        class="form-group                          <?php if (isset($e['email'])) {if (!empty($e['email'])) {echo 'has-error';}} elseif (isset($e['pasvemail'])) {echo 'has-error';}?><?php if (isset($e['j'])) {echo 'has-success';}?>">
        <label class="col-sm-2 col-md-2 control-label">Adresse Email</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"
            placeholder="Ex: exemple@exemple.com" />
          <span
            class="help-block"><?php if (isset($e['email'])) {if (!empty($e['email'])) {echo $e['email'];}} elseif (isset($e['pasvemail'])) {echo $e['pasvemail'];}?></span>
        </div>
      </div>
      <div
        class="form-group                          <?php if (isset($e['adresse'])) {if (!empty($e['adresse'])) {echo 'has-error';}} elseif (isset($e['pasvalideadresse'])) {echo 'has-error';}?><?php if (isset($e['k'])) {echo 'has-success';}?>">
        <label class="col-sm-2 col-md-2 control-label">Adresse</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="adresse" value="<?php echo $adresse; ?>"
            placeholder="Ex: Rue De La République" />
          <span
            class="help-block"><?php if (isset($e['adresse'])) {if (!empty($e['adresse'])) {echo $e['adresse'];}} elseif (isset($e['pasvalideadresse'])) {echo $e['pasvalideadresse'];}?></span>
        </div>
      </div>
      <div
        class="form-group                          <?php if (isset($e['cin'])) {if (!empty($e['cin'])) {echo 'has-error';}}?><?php if (isset($e['isnum'])) {if (!empty($e['isnum'])) {echo 'has-error';}}?><?php if (isset($e['l'])) {echo 'has-success';}?>">
        <label class="col-sm-2 col-md-2 control-label">Numéro C.I.N</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="cin" value="<?php echo $cin; ?>" maxlength="8"
            placeholder="Ex: 12345678" />
          <span class="help-block"><?php if (isset($e['cin'])) {if (!empty($e['cin'])) {echo $e['cin'];}}?>
<?php if (isset($e['isnum'])) {if (!empty($e['isnum'])) {echo $e['isnum'];}}?></span>
        </div>
      </div>
      <div
        class="form-group                          <?php if (isset($e['MATRICULEFISCALE'])) {if (!empty($e['MATRICULEFISCALE'])) {echo 'has-error';}} elseif (isset($e['pasvalideimm'])) {echo 'has-error';}?><?php if (isset($e['m'])) {echo 'has-success';}?>">
        <label class="col-sm-2 col-md-2 control-label">Matricule Fiscale</label>
        <div class="col-sm-10 col-md-8">
          <input type="text" class="form-control" name="matriculefiscale" value="<?php echo $matriculefiscal; ?>"
            placeholder="Ex: 123456/Y/Z/T/000" />
          <span
            class="help-block"><?php if (isset($e['MATRICULEFISCALE'])) {if (!empty($e['MATRICULEFISCALE'])) {echo $e['MATRICULEFISCALE'];}} elseif (isset($e['pasvalideimm'])) {echo $e['pasvalideimm'];}?></span>
        </div>
      </div>
      <div class="form-group form-actions">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <a href="ajout_employe.php" class="btn btn-default">Annuler </a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include $tpl . 'footer.php';?>