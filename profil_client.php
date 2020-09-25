<?php
$title        = "Profil Client";
$ClientNavbar = "";
include 'init.php';
$req = "select p.*, MATRICULEFISCALE from client as c JOIN personne as p where (p.ID = c.REFPERSONNE) AND (c.REFPERSONNE=" . $_SESSION['ID_CLIENT'] . ");";
$res = $conn->query($req);
$h   = $res->fetch_assoc();
$e   = array();
$v   = 0;
if (!empty($_POST)) {
 $nom      = $conn->real_escape_string($_POST['Nom']);
 $prenom   = $conn->real_escape_string($_POST['Prenom']);
 $datenais = $conn->real_escape_string($_POST['datenaissance']);
 $email    = $conn->real_escape_string($_POST['email']);
 $adresse  = $conn->real_escape_string($_POST['adresse']);
 $mdp      = $conn->real_escape_string($_POST['mdp']);
 if (!preg_match("/^\D{1,15}$/", $nom)) {
  $e["pasvalidenom"] = "Un Nom Doit Contenir Seulement Des Alphabets Et Du 1 à 15 Chiffres Au Max!";
 } else {
  $v++;
 }
 if (!preg_match("/^\D{1,15}$/", $prenom)) {
  $e["pasvalideprenom"] = "Un Prénom Doit Contenir Seulement Des Alphabets Et Du 1 à 15 Chiffres Au Max!";
 } else {
  $v++;
 }
 if (!preg_match("/^(((((1[26]|2[048])00)|[12]\d([2468][048]|[13579][26]|0[48]))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|[12]\d))))|((([12]\d([02468][1235679]|[13579][01345789]))|((1[1345789]|2[1235679])00))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|1\d|2[0-8])))))$/", $datenais)) {
  $e["pasvalide"] = "Respectez Le Format Du Date!";
 } else {
  $v++;
 }
 if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/", $email)) {
  $e["pasvemail"] = "Respectez Le Format De L'email!";
 } else {
  $v++;
 }
 if (!preg_match("/^.{5,30}$/", $adresse)) {
  $e["pasvalideadresse"] = "Une Adresse Doit Contenir Seulement Des Alphabets Et Du 5 à 30 Chiffres Au Max!";
 } else {
  $v++;
 }
 if ($v == 5) {
  $requp = "UPDATE personne set
        Nom = '" . $nom . "',
		Prenom = '" . $prenom . "',
		datenaissance = '" . $datenais . "',
		email = '" . $email . "',
		mdp = '" . $mdp . "',
		adresse = '" . $adresse . "'
		where ID=" . $_SESSION['ID_CLIENT'];
  $resupdate = $conn->query($requp);
 }
}
?>








<div id="content" class="profil">
  <?php /* var_dump($_POST); var_dump($_FILES); */; ?>
  <div id="panel" class="profile">
    <h3>Paramétres Du Profile</h3>
    <p class="intro"> Changer Les Informations Du Votre Compte, Photo, Votre Login, etc.</p>
    <form enctype="multipart/form-data" method="POST" id="form">
      <div class="form-group avatar-field clearfix">
        <div class="col-sm-3">
          <img alt="7" class="img-responsive img-circle" src="<?php echo $imageclient; ?>" />
        </div>
        <div class="col-sm-9">
          <label>Ajouter Votre Photo Personnalisé</label>
          <input type="file" name="fileToUpload" id="fileToUpload" />
          <p id="uploadmessage">
            <?php
$target_dir = $uploads;
if (!empty($_FILES["fileToUpload"]["name"])) {
 $target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk      = 1;
 $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
 $check         = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

 if ($check !== false) {
  $uploadOk = 1;
 } else {
  echo "Ce Fichier N'est Pas Une Image! ";
  $uploadOk = 0;
 }
 if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Votre Fichier Est Trop Volumineux.";
  $uploadOk = 0;
 }
 if ((strcasecmp($imageFileType, "jpg") != 0) && (!strcasecmp($imageFileType, "png") != 0) && (!strcasecmp($imageFileType, "jpeg") != 0)
  && (strcasecmp($imageFileType, "gif") != 0)) {
  echo "Seulement Fichiers JPG, JPEG, PNG & GIF Sont Autorisés.";
  $uploadOk = 0;
 }
 if ($uploadOk == 0) {
  echo " Désolé, Votre Fichier N'est Pas Uploadé!";
 } else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
   echo "<span>Le Fichier <span>" . basename($_FILES["fileToUpload"]["name"]) . "</span> Est Uploadé.</span>";
   $nvimage           = basename($target_file);
   $reqim             = "UPDATE personne SET image='" . $nvimage . "' WHERE ID=" . $_SESSION['ID_CLIENT'];
   $resim             = $conn->query($reqim);
   $_SESSION['image'] = $nvimage;
   header('location:profil_client.php');
  } else {
   echo " Désolé, Ily'a Un Erreur Dans L'Upload De Votre Fichier.";
  }
 }
}
?>
          </p>
        </div>
      </div>
      <div
        class="form-group <?php if (isset($e["pasvalidenom"])) {echo 'has-error';} ?><?php if (isset($e['g'])) {echo 'has-success';} ?>">
        <label>Nom</label>
        <input type="text" class="form-control" name="Nom" value="<?php echo $h['Nom']; ?>" placeholder="Ex: Mohamed" />
        <span class="help-block"><?php if (isset($e["pasvalidenom"])) {echo $e["pasvalidenom"];} ?></span>
      </div>
      <div
        class="form-group <?php if (isset($e["pasvalideprenom"])) {echo 'has-error';} ?><?php if (isset($e['h'])) {echo 'has-success';} ?>">
        <label>Prénom</label>
        <input type="text" class="form-control" name="Prenom" value="<?php echo $h['Prenom']; ?>"
          placeholder="Ex: Kerkni" />
        <span class="help-block"><?php if (isset($e["pasvalideprenom"])) {echo $e["pasvalideprenom"];} ?></span>
      </div>
      <div
        class="form-group <?php if (isset($e["pasvemail"])) {echo 'has-error';} ?><?php if (isset($e['j'])) {echo 'has-success';} ?>">
        <label>Adresse Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo $h['email']; ?>"
          placeholder="Ex: exemple@exemple.com" />
        <span class="help-block"><?php if (isset($e["pasvemail"])) {echo $e["pasvemail"];} ?></span>
      </div>
      <div
        class="form-group <?php if (isset($e["pasvalide"])) {echo 'has-error';} ?><?php if (isset($e['i'])) {echo 'has-success';} ?>">
        <label>Date De Naissance</label>
        <input type="text" class="form-control" name="datenaissance" value="<?php echo $h['datenaissance']; ?>"
          placeholder="Ex: 1999-12-31" />
        <span class="help-block"><?php if (isset($e["pasvalide"])) {echo $e["pasvalide"];} ?></span>
      </div>
      <div
        class="form-group <?php if (isset($e["pasvalideadresse"])) {echo 'has-error';} ?><?php if (isset($e['k'])) {echo 'has-success';} ?>">
        <label>Adresse</label>
        <input type="text" class="form-control" name="adresse" value="<?php echo $h['adresse']; ?>"
          placeholder="Ex: Rue De La République" />
        <span class="help-block"><?php if (isset($e["pasvalideadresse"])) {echo $e["pasvalideadresse"];} ?></span>
      </div>
      <div
        class="form-group <?php if (isset($e["pasvalideadresse"])) {echo 'has-error';} ?><?php if (isset($e['k'])) {echo 'has-success';} ?>">
        <label>Mot De Passe</label>
        <input type="password" class="form-control" name="mdp" value="<?php echo $h['mdp']; ?>"
          placeholder="Ex: Rue De La République" />
        <span class="help-block"><?php ; ?></span>
      </div>
      <div class="form-group">
        <label>Matricule Fiscale</label>
        <input type="text" class="form-control" value="<?php echo $h['MATRICULEFISCALE']; ?>" disabled />
      </div>
      <div class="form-group action">
        <input type="submit" class="btn btn-success" value="Enregistrer" id="submit" />
        <a href="profil_client.php" class="btn btn-default">Annuler</a>
      </div>
    </form>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>