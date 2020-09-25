<?php
$title = "Affichage Des Projets";
include 'init.php'
; ?>
<?php
$data      = array();
$perpage   = 7;
$cpage     = 1;
$req5      = "SELECT count(*) as Nb from projet";
$res5      = $conn->query($req5);
$nb        = $res5->fetch_assoc();
$nbrprojet = $nb['Nb'];
$nbrpages  = ceil($nbrprojet / $perpage);
if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpages)) {
 $cpage = $_GET['p'];
} else {
 $cpage = 1;
}
$req = "SELECT * from projet LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
$res = $conn->query($req);
?>
<div id="content" class="affproj">
  <div class="content-wrapper"><a href="ajout_projet.php" class="btn btn-primary">Ajout Un Projet</a></div>
  <div class="menubar">
    <div class="page-title">
      <h3><strong>Liste Des Projets</strong></h3>
    </div>
  </div>
  <div class="content-wrapper">
    <?php if ($nb['Nb'] != 0) {
 ?>
    <table class="table table-hover proj">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Client Demandeur</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $res->fetch_assoc()) { ?>
        <tr>
          <td>
            <?php if (strlen($r['Nom_Proj']) < 10) {echo $r['Nom_Proj'];} else {echo mb_substr($r['Nom_Proj'], 0, 10, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php if (strlen($r['Description_Proj']) < 20) {echo $r['Description_Proj'];} else {echo mb_substr($r['Description_Proj'], 0, 20, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php

  $req100 = "select Nom,Prenom from personne where ID=" . $r['Refclient'];
  $res100 = $conn->query($req100);
  $rr     = $res100->fetch_assoc();
  $np     = $rr['Nom'] . " " . $rr['Prenom'];
  if (strlen($np) < 10) {echo $rr['Nom'] . " " . $rr['Prenom'];} else {echo mb_substr($np, 0, 10, 'UTF-8') . " ...";} ?>
          </td>
          <td><a href="lire.php?id_projet=<?php echo $r['id_projet'] . "&p=" . $_GET['p']; ?>"
              class="btn btn-primary">Lire</a>
            <a href="ajout_tache.php?id_projet=<?php echo $r['id_projet']; ?>" class="btn btn-success">Ajout Tâche</a>
            <a href="affichage_taches.php?id_projet=<?php echo $r['id_projet'] . "&p=1"; ?>"
              class="btn btn-warning">Liste Tâches</a>
            <a href="modifier_projet.php?id_projet=<?php echo $r['id_projet']; ?>" class="btn btn-info">Modifier</a>
            <a href="supprimer.php?id_projet=<?php echo $r['id_projet']; ?>" class="btn btn-danger">Supprimer</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nb['Nb'] > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="affichage_projet.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_projet.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_projet.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nb['Nb'] >= 1) and ($nb['Nb'] <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="affichage_projet.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpages; $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_projet.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_projet.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il n'ya Aucun Projet à ce moment.</a></div>";} ?>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>