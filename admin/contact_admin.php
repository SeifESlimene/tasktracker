<?php
$title = "Contact";
include 'init.php';
$perpage         = 7;
$cpage           = 1;
$req5            = "SELECT count(*) as Nb FROM contact where Emeteur != 'Admin'";
$res5            = $conn->query($req5);
$nb              = $res5->fetch_assoc();
$req7            = "SELECT count(*) as Nb1 FROM contact where Emeteur = 'Admin'";
$res7            = $conn->query($req7);
$nb1             = $res7->fetch_assoc();
$nbrmessagerecus = $nb['Nb'];
$nbrmessageenvoy = $nb1['Nb1'];
$nbrpagesrec     = ceil($nbrmessagerecus / $perpage);
$nbrpagesenv     = ceil($nbrmessageenvoy / $perpage);
if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpagesrec)) {
 $cpage = $_GET['p'];
} else {
 $cpage = 1;
}
if (isset($_GET['p1'])) {
 if ($_GET['p1'] < 1) {
  $cpage = 1;
 } elseif ($_GET['p1'] > $nbrpagesenv) {
  $cpage = $nbrpagesenv;
 } else {
  $cpage = $_GET['p1'];
 }
}
$req4    = "SELECT * FROM contact where Emeteur != 'Admin' LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
$res4    = $conn->query($req4);
$req8    = "SELECT * FROM contact where Emeteur = 'Admin' LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
$res8    = $conn->query($req8);
$t       = $c       = $e       = $m       = $s       = $em       = $eo       = 0;
$req_emp = "SELECT * FROM personne JOIN employe WHERE employe.REFPERSONNEE = personne.ID";
$res1    = $conn->query($req_emp);
$req_cli = "SELECT * FROM personne JOIN client WHERE client.REFPERSONNE = personne.ID";
$res2    = $conn->query($req_cli);
if (!empty($_POST)) {
 if (((!empty($_POST['client'])) and ($_POST['client'] != '--Choisir--')) xor (((!empty($_POST['employe']))) and ($_POST['employe'] != '--Choisir--'))) {
  if (!empty($_POST['client']) and ($_POST['client'] != '--Choisir--')) {
   $client = $_POST['client'];
   $c++;
  }
  if (!empty($_POST['employe']) and ($_POST['employe'] != '--Choisir--')) {
   $employe = $_POST['employe'];
   $e++;
  }
 } else {
  $t++;
 }
 if (!empty($_POST['objet'])) {
  $objet = $_POST['objet'];
  $m++;
 } else {
  $eo++;
 }
 if (!empty($_POST['message'])) {
  $message = $_POST['message'];
  $m++;
 } else {
  $em++;
 }
}
if (($m == 2) && ($c == 1)) {
 $req  = "INSERT INTO contact(Emeteur, Destinataire, objet, message) VALUES ('Admin', '" . $client . "', '" . $objet . "', '" . $message . "')";
 $res3 = $conn->query($req);
 $s++;
} elseif (($m == 2) && ($e == 1)) {
 $req1 = "INSERT INTO contact(Emeteur, Destinataire, objet, message) VALUES ('Admin', '" . $employe . "', '" . $objet . "', '" . $message . "')";
 $res4 = $conn->query($req1);
 $s++;
}
?>



<!-- Message Reçus -->
<?php if (isset($_GET['mesrecus'])) {
 ?>
<div id="content" class="contact recus">
  <div id="pager">
    <a href="contact_admin.php" class="btn btn-primary">Envoyer Un Message</a> <a href="Contact_Admin.php?mesenv&p1=1"
      class="btn btn-warning">Message Envoyés</a>
  </div>
  <hr>
  <div class="content-wrapper">
    <?php if ($nbrmessagerecus != 0) { ?>
    <table class="table table-hover proj2 rec">
      <thead>
        <tr>
          <th></th>
          <th>Emetteur</th>
          <th>Date</th>
          <th>Heure</th>
          <th>Objet Du Message</th>
          <th>Message</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r9 = $res4->fetch_assoc()) { ?>
        <tr>
          <td>
            <?php
$req1  = "SELECT * FROM personne as p join contact as c WHERE c.REFPERSONNE = p.ID and c.REFPERSONNE=" . $r9['REFPERSONNE'];
  $res1  = $conn->query($req1);
  $image = $res1->fetch_assoc();
  if ($r9['REFPERSONNE'] != 0) {
   if ($image['image'] == 'Client') {echo "<img src='../" . $images . "Client.png' width='33px' height='42px'/>";} elseif ($image['image'] == 'Employé') {echo "<img src='../" . $images . "Employe.png' width='33px' height='42px'/>";} else {echo "<img src='../Data/Uploads/" . $image['image'] . "' width='33px' height='42px'/>";}} else {echo "<i class='fa fa-user fa-3x'></i>";}
  ?>
          </td>
          <td><?php echo $r9['Emeteur']; ?></td>
          <td><?php echo substr($r9['Date'], 0, 10); ?></td>
          <td><?php echo substr($r9['Date'], 11, 5); ?></td>
          <td><?php echo mb_substr($r9['objet'], 0, 15, 'UTF-8') . "..."; ?></td>
          <td><?php echo mb_substr($r9['message'], 0, 15, 'UTF-8') . "..."; ?></td>
          <td>
            <a href="lire.Php?mesrecus&message=<?php echo $r9['ID'] . "&p=" . $cpage; ?>"
              class="btn btn-primary">Lire</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nbrmessagerecus > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>>
          <a
            href="contact_admin.php?mesrecus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>">
            <span>&laquo;</span>
          </a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>>
          <a href="contact_admin.php?mesrecus&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpagesrec) {echo "class='disabled'";}} ?>>
          <a
            href="contact_admin.php?mesrecus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpagesrec - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpagesrec;}} ?>">
            <span>&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nbrmessagerecus >= 1) && ($nbrmessagerecus <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>>
          <a
            href="contact_admin.php?mesrecus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>">
            <span>&laquo;</span>
          </a>
        </li>
        <?php for ($i = 1; $i <= $nbrpagesrec; $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>>
          <a href="contact_admin.php?mesrecus&p=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpagesrec) {echo "class='disabled'";}} ?>>
          <a
            href="contact_admin.php?mesrecus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpagesrec - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpagesrec;}} ?>">
            <span>&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <?php } ?>
  </div>
  <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il n'ya aucun message reçu à ce moment.</a></div>";} ?>
</div>






<!-- Message Envoyés -->
<?php } elseif (isset($_GET['mesenv'])) { ?>
<div id="content" class="contact">
  <div id="pager">
    <a href="contact_admin.php" class="btn btn-primary">Envoyer Un Message</a> <a href="Contact_Admin.php?mesrecus&p=1"
      class="btn btn-info">Message Reçus</a>
  </div>
  <hr>
  <div class="content-wrapper">
    <?php if ($nb1['Nb1'] != 0) { ?>
    <table class="table table-hover proj2 rec">
      <thead>
        <tr>
          <th>Date D'envoi</th>
          <th>Heure</th>
          <th>Objet Du Message</th>
          <th>Message</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $res8->fetch_assoc()) { ?>
        <tr>
          <td><?php echo substr($r['Date'], 0, 10); ?></td>
          <td><?php echo substr($r['Date'], 11, 5); ?></td>
          <td><?php echo mb_substr($r['objet'], 0, 15, 'UTF-8') . "..."; ?></td>
          <td><?php echo mb_substr($r['message'], 0, 15, 'UTF-8') . "..."; ?></td>
          <td>
            <a href="lire.Php?mesenv&message=<?php echo $r['ID'] . "&p1=" . $cpage; ?>" class="btn btn-primary">Lire</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nb1['Nb1'] > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p1'])) {if ($_GET['p1'] == 1) {echo "class='disabled'";}} ?>><a
            href="contact_admin.php?mesenv&p1=<?php if (isset($_GET['p1'])) {if ($_GET['p1'] >= 2) {echo ($_GET['p1'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p1'])) {if ($_GET['p1'] == $i) {echo "class='active'";}} ?>><a
            href="contact_admin.php?mesenv&p1=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p1'])) {if ($_GET['p1'] == $nbrpagesenv) {echo "class='disabled'";}} ?>><a
            href="contact_admin.php?mesenv&p1=<?php if (isset($_GET['p1'])) {if ($_GET['p1'] <= $nbrpagesenv - 1) {echo ($_GET['p1'] + 1);} else {echo $nbrpagesenv;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nb1['Nb1'] >= 1) and ($nb1['Nb1'] <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p1'])) {if ($_GET['p1'] == 1) {echo "class='disabled'";}} ?>><a
            href="contact_admin.php?mesenv&p1=<?php if (isset($_GET['p1'])) {if ($_GET['p1'] >= 2) {echo ($_GET['p1'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpagesenv; $i++) { ?>
        <li <?php if (isset($_GET['p1'])) {if ($_GET['p1'] == $i) {echo "class='active'";}} ?>><a
            href="contact_admin.php?mesenv&p1=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p1'])) {if ($_GET['p1'] == $nbrpagesenv) {echo "class='disabled'";}} ?>><a
            href="contact_admin.php?mesenv&p1=<?php if (isset($_GET['p1'])) {if ($_GET['p1'] <= $nbrpagesenv - 1) {echo ($_GET['p1'] + 1);} else {echo $nbrpagesenv;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
  </div>
  <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il n'ya aucun message envoyé à ce moment.</a></div>";} ?>
</div>
<?php } else {
 ?>







<!-- Envoyer Un Message -->
<div id="content" class="contact">
  <div id="pager">
    <?php
if ($t == 1) {
  echo "<div class='alert alert-danger'>Sélectionner Un Et Un Seul Destinataire!<span class='glyphicon glyphicon-eye-open'></span></div>";
 }
 if ($em == 1) {
  echo "<div class='alert alert-danger'>Champ Message Est Obligatoire!<span class='glyphicon glyphicon-eye-open'></span></div>";
 }
 if ($eo == 1) {
  echo "<div class='alert alert-danger'>Champ Objet Du Message Est Obligatoire!<span class='glyphicon glyphicon-eye-open'></span></div>";
 }
 if ($s == 1) {
  echo "<div class='alert alert-success'>Message Envoyé Avec Succés!<span class='glyphicon glyphicon glyphicon-ok'></span></div>";
 }
 ?>
  </div>
  <a href="contact_admin.php?mesenv&p1=1" class="btn btn-warning">Message Envoyés</a> <a
    href="contact_admin.php?mesrecus&p=1" class="btn btn-info">Message Reçus</a>
  <hr>
  <div class="row col-lg-10 col-lg-offset-1">
    <form method="POST">
      <label "control-label">Choisir le client :</label>
      <select class="form-control" name="client">
        <option class="active"> <span><?php echo "--Choisir--"; ?><span></option>
        <?php while ($r2 = $res2->fetch_assoc()) {echo "<option>" . $r2['Nom'] . " " . $r2['Prenom'] . "</option>";} ?>
      </select>
      <label>Choisir L'employé :</label>
      <select class="form-control" name="employe">
        <option class="active"><span><?php echo "--Choisir--"; ?></span></option>
        <?php while ($r1 = $res1->fetch_assoc()) {echo "<option>" . $r1['Nom'] . " " . $r1['Prenom'] . "</option>";} ?>
      </select>
      <div class="row control-group b1">
        <div class="form-group col-xs-12 floating-label-form-group controls">
          <label>Objet Du Message</label>
          <input type="text" class="form-control" placeholder="Objet Du Message" name="objet"
            value="<?php if (isset($objet)) {echo $objet;} ?>">
        </div>
      </div>
      <div class="row control-group b1">
        <div class="form-group col-xs-12 floating-label-form-group controls">
          <label>Message</label>
          <textarea rows="6" class="form-control" placeholder="Message ..."
            name="message"><?php if (isset($message)) {echo $message;} ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-xs-12 text-center">
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
      </div>
    </form>
  </div>
</div>









<?php } ?>
<?php include $tpl . "footer.php"; ?>