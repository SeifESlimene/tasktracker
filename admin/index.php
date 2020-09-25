<?php
$title    = "Index";
$noNavbar = "";
include "init.Php";
?>
<?php
session_start();
$email = "";
$mdp   = "";
$e     = array();
if (!empty($_POST)) {
 $email = $_POST['adresse_email'];
 $mdp   = $_POST['motpasse'];
 if (empty($email)) {
  $e["Email"] = "Le Champ 'Adresse Email' Est Obligatoire";
 }
 if (empty($mdp)) {
  $e["MDP"] = "Le Champ 'Mot De Passe' Est Obligatoire";
 }
 if (sizeof($e) < 1) {
  if (($email == 'user@user.com') and ($mdp == 'user')) {
   $_SESSION['emailadmin'] = 'user@user.com';
   $_SESSION['passadmin']  = 'user';
   header('location:Espace_Admin.Php');
  } else {
   header('location:Index.Php');
  }
 }
}
?>

<body id="signin">
  <div class="bg clear">
    <a class="logo"><i class="fa fa-diamond fa-3x"></i></a>
    <h3><B>Administration</B></h3>
    <div class="content">
      <form id="new-customer" class="form-horizontal" method="post">
        <div class="fields <?php if (isset($e['Email'])) {if (!empty($e['Email'])) {echo 'has-error';}} ?>">
          <strong>Adresse Email</strong>
          <input type="text" class="form-control" name="adresse_email" value="<?php echo $email; ?>" />
          <span
            class="help-block"><?php if (isset($e['Email'])) {if (!empty($e['Email'])) {echo $e['Email'];}} ?></span>
        </div>
        <div class="fields <?php if (isset($e['MDP'])) {if (!empty($e['MDP'])) {echo 'has-error';}} ?>">
          <strong>Mot De Passe</strong>
          <input class="form-control" type="password" name="motpasse" value="<?php echo $mdp; ?>" />
          <span class="help-block"><?php if (isset($e['MDP'])) {if (!empty($e['MDP'])) {echo $e['MDP'];}} ?></span>
        </div>
        <div class="actions">
          <button type="submit" class="btn btn-primary btn-lg">Accéder A Mon Espace</button>
        </div>
      </form>
    </div>
  </div>
  <?php include $tpl . "footer.php"; ?>