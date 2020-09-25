<?php
$title        = "Contact - Client";
$ClientNavbar = "";
include 'init.php';
$e = array();
if (isset($_POST['objet']) && isset($_POST['message'])) {
 if (!empty($_POST)) {
  if (empty($_POST['objet'])) {
   $e['objet'] = "Champ Objet Du Message Doit être Remplit!";
  } else {
   $objet = $conn->real_escape_string($_POST['objet']);
  }
  if (empty($_POST['message'])) {
   $e['message'] = "Remplir Votre Champ Message!";
  } else {
   $message = $conn->real_escape_string($_POST['message']);
  }
  if (sizeof($e) < 1) {
   $rcc    = "INSERT into contact(Emeteur,destinataire,objet,message,REFPERSONNE) values ('" . $_SESSION['Email_Client'] . "','Admin','" . $objet . "','" . $message . "'," . $_SESSION['ID_CLIENT'] . ")";
   $resrcc = $conn->query($rcc);
  }
 }
}
if (!empty($_GET)) {
 if ($_GET['f'] == "message_reçus") {
  $perpage    = 7;
  $cpage      = 1;
  $req5       = "SELECT count(*) as Nb FROM contact Where Emeteur='Admin' and Destinataire='" . $_SESSION['npc'] . "'";
  $res5       = $conn->query($req5);
  $nb         = $res5->fetch_assoc();
  $nbrmessage = $nb['Nb'];
  $nbrpages   = ceil($nbrmessage / $perpage);
  if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpages)) {
   $cpage = $_GET['p'];
  } else {
   $cpage = 1;
  }
  $req4 = "SELECT * FROM contact Where Emeteur='Admin' and Destinataire='" . $_SESSION['npc'] . "' LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
  $res4 = $conn->query($req4);
 }
 if ($_GET['f'] == "message_envoyés") {
  $perpage    = 7;
  $cpage      = 1;
  $z1         = "select count(*) as nbmesenv from contact where Emeteur='" . $_SESSION['Email_Client'] . "'";
  $rz1        = $conn->query($z1);
  $nbmesenv   = $rz1->fetch_assoc();
  $nbrmessage = $nbmesenv['nbmesenv'];
  $nbrpages   = ceil($nbrmessage / $perpage);
  if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpages)) {
   $cpage = $_GET['p'];
  } else {
   $cpage = 1;
  }
  $req4 = "SELECT * FROM contact Where Emeteur='" . $_SESSION['Email_Client'] . "' LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
  $res4 = $conn->query($req4);
 }
}
?>

















<!-- Message Envoyés -->
<?php if ((isset($_GET['f'])) && ($_GET['f'] == 'message_envoyés')) { ?>
<div id="content" class="contact">
  <div id="pager">
    <a href="contact_client.php" class="btn btn-primary">Envoyer Un Message</a> <a
      href="contact_client.php?f=message_reçus&p=1" class="btn btn-info">Message Reçus</a>
  </div>
  <hr>
  <div class="content-wrapper contcli">
    <?php if ($nbrmessage != 0) { ?>
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
        <?php while ($r = $res4->fetch_assoc()) { ?>
        <tr>
          <td><?php echo substr($r['Date'], 0, 10); ?></td>
          <td><?php echo substr($r['Date'], 11, 5); ?></td>
          <td><?php echo mb_substr($r['objet'], 0, 15, 'UTF-8') . "..."; ?></td>
          <td><?php echo mb_substr($r['message'], 0, 15, 'UTF-8') . "..."; ?></td>
          <td><a href="lire.php?f=message_envoyés&message=<?php echo $r['ID'] . "&p=" . $cpage . "&s=cli"; ?>"
              class="btn btn-primary">Lire</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nbrpages > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="contact_client.php?f=message_envoyés&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="contact_client.php?f=message_envoyés&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="contact_client.php?f=message_envoyés&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpage - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nbrpages >= 1) and ($nbrpages <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="contact_client.php?f=message_envoyés&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpages; $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="contact_client.php?f=message_envoyés&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="contact_client.php?f=message_envoyés&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
  </div>
  <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il n'ya aucun message envoyé à ce moment.</a></div>";} ?>
</div>
<!-- Fin Message Envoyés -->














<!-- Messages Reçus -->
<?php } elseif ((isset($_GET['f'])) && ($_GET['f'] == 'message_reçus')) { ?>
<div id="content" class="contact">
  <div id="pager">
    <a href="Contact_Client.php" class="btn btn-primary">Envoyer Un Message</a> <a
      href="Contact_Client.php?f=message_envoyés&p=1" class="btn btn-warning">Messages Envoyés</a></p>
  </div>
  <hr>
  <div class="content-wrapper contcli">
    <?php if ($nb['Nb'] != 0) { ?>
    <table class="table table-hover proj2 kr1">
      <thead>
        <tr>
          <th>Date</th>
          <th>Heure</th>
          <th>Objet Du Message</th>
          <th>Message</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $c = array();while ($r = $res4->fetch_assoc()) {$c = $r; ?>
        <tr>
          <td><?php echo substr($r['Date'], 0, 10); ?></td>
          <td><?php echo substr($r['Date'], 11, 5); ?></td>
          <td><?php echo mb_substr($r['objet'], 0, 25, 'UTF-8') . "..."; ?></td>
          <td><?php echo mb_substr($r['message'], 0, 20, 'UTF-8') . "..."; ?></td>
          <td><a href="Lire.php?f=message_reçus&p=<?php echo $cpage . "&message=" . $r['ID'] . "&s=cli"; ?>"
              class="btn btn-primary">Lire</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nb['Nb'] > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="Contact_Client.php?f=message_reçus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="Contact_Client.php?f=message_reçus&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="Contact_Client.php?f=message_reçus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nb['Nb'] >= 1) and ($nb['Nb'] <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="Contact_Client.php?f=message_reçus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpages; $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="Contact_Client.php?f=message_reçus&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="Contact_Client.php?f=message_reçus&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il n'ya aucun message reçu à ce moment.</a></div>";} ?>
  </div>
</div>
<?php exit(); ?>
<!-- Fin Messages Reçus -->
















<!-- Envoyer Un Message -->
<?php } else { ?>
<div id="content" class="cadc">
  <p><a class="btn btn-info btn-lg" href="Contact_client.php?f=message_reçus&p=1">Message Reçus</a> <a
      href="Contact_Client.php?f=message_envoyés&p=1" class="btn btn-warning btn-lg">Message Envoyés</a></p>
  <hr>
  <div class="row content-row">
    <div class="col-lg-8 col-lg-offset-2">
      <form name="sentMessage" method="post" action="">
        <div
          class="form-group col-xs-12 floating-label-form-group controls <?php if (isset($e['objet'])) {if (!empty($e['objet'])) {echo 'has-error';}} ?>">
          <label>Objet Du Message</label>
          <input type="text" class="form-control" placeholder="Objet Du Message" id="objet" name="objet"
            value="<?php if (isset($objet)) {echo $objet;} ?>">
          <p class="help-block text-danger"><?php if (isset($e['objet'])) {echo $e['objet'];} ?></p>
        </div>
        <div
          class="form-group col-xs-12 floating-label-form-group controls <?php if (isset($e['message'])) {if (!empty($e['message'])) {echo 'has-error';}} ?>">
          <label>Message</label>
          <textarea rows="10" class="form-control" placeholder="Message ..." id="message"
            name="message"><?php if (isset($message)) {echo $message;} ?></textarea>
          <p class="help-block text-danger"><?php if (isset($e['message'])) {echo $e['message'];} ?></p>
        </div>
        <div class="row">
          <div class="form-group col-xs-12">
            <button type="submit" class="btn btn-outline-dark">Envoyer</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php if (isset($_POST['objet']) && isset($_POST['message'])) { ?>
  <div class="search-overlay rubberBand" <?php if (sizeof($e) < 1) {echo 'style="display: block;"';} ?>>
    <div class='<?php if (sizeof($e) < 1) {echo 'suc';} ?>'>
      <?php if (sizeof($e) < 1) {echo 'Votre Message Est Envoyé';} ?>
    </div>
  </div>
  <?php } ?>
</div>
<?php } ?>
<!-- Fin Envoyer Un Message -->

























<?php include $tpl . "Footer.Php"; ?>