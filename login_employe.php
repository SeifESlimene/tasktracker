<?php
$title = "Login Employé";
include "init.php";
if (!empty($_SESSION['Email_Emp'])) {
 header('location:espace_emp.php');
} else {
 $email = "";
 $mdp   = "";
 $e     = array();
 if (!empty($_POST)) {
  $email = $_POST['adresse_email'];
  $mdp   = $_POST['motpasse'];
  if (empty($email)) {
   $e['Email'] = "Le Champ 'Adresse Email' Est Obligatoire";
  }
  if (empty($mdp)) {
   $e['MDP'] = "Le Champ 'Mot De Passe' Est Obligatoire";
  }
  if (sizeof($e) < 1) {
   $req = "SELECT p.* FROM `personne` AS p JOIN `employe` AS e WHERE ((e.`REFPERSONNEE`=p.`ID`) AND (p.`email`='" . $email . "') AND (p.`mdp`='" . $mdp . "'))";
   $res = $conn->query($req);
   while ($r = $res->fetch_assoc()) {
    if (($email == $r['email']) && ($mdp == $r['mdp'])) {
     $_SESSION['ID_EMPLOYE'] = $r['ID'];
     $_SESSION['Email_Emp']  = $email;
     $_SESSION['Pass_Emp']   = $mdp;
     $_SESSION['imageemp']   = $r['image'];
     $_SESSION['npe']        = $r['Nom'] . " " . $r['Prenom'];
     header('location:espace_emp.php');
    }
   }
  }
 }
}
?>

<body id="signin">
  <div class="bg clear">
    <div class="message a">
      <a href="index.php">
        <h2 class="mes">Accueil</h2>
      </a>
    </div>
    <a class="logo"><i class="fa fa-user fa-3x"></i></a>
    <h3>Espace Employé</h3>
    <div class="content">
      <form id="new-customer" class="form-horizontal" method="post">
        <div class="fields <?php if (isset($e['Email'])) {if (!empty($e['Email'])) {echo 'has-error';}} ?>">
          <strong>Adresse Email</strong>
          <input type="text" class="form-control" name="adresse_email" value="<?php echo $email; ?>" />
          <span
            class="help-block"><?php if (isset($e['Email'])) {if (!empty($e['Email'])) {echo $e['Email'];}} ?></span>
        </div>
        <div class="fields <?php if (isset($e['MDP'])) {if (!empty($e['MDP'])) {echo 'has-error';}} ?> ">
          <strong>Mot De Passe</strong>
          <input class="form-control" type="password" name="motpasse" value="<?php echo $mdp; ?>" />
          <span class="help-block"><?php if (isset($e['MDP'])) {if (!empty($e['MDP'])) {echo $e['MDP'];}} ?></span>
        </div>
        <div class="actions">
          <button type="submit" class="btn btn-primary btn-lg">Accéder à Mon Espace </button>
        </div>
      </form>
    </div>
    <div class="bottom-wrapper">
      <div class="message b">
        <a href="login_client.php"><input type="button" class="btn btn-primary btn-lg" value="Espace Client">
      </div>
    </div>
  </div>
  <?php include $tpl . "footer.php"; ?>