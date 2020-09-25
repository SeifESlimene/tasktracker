<?php
$title = "Affichage Des Tâches";
include 'init.php';
?>
<?php
if (isset($_GET['id_projet'])) {
 if (!empty($_GET['id_projet'])) {
  $id_projet        = $_GET['id_projet'];
  $req_liste_tache  = "select * from `tache` where REFPROJET=" . $id_projet;
  $res              = $conn->query($req_liste_tache);
  $req_liste_tache1 = "select * from projet where id_projet=" . $id_projet;
  $res1             = $conn->query($req_liste_tache1);
  while ($r = $res1->fetch_assoc()) {
   $n = $r['Nom_Proj'];
  }
 }
}
$perpage  = 7;
$cpage    = 1;
$req5     = "SELECT count(*) as Nb from tache where REFPROJET=" . $id_projet . ";";
$res5     = $conn->query($req5);
$nb       = $res5->fetch_assoc();
$nbrtache = $nb['Nb'];
$nbrpages = ceil($nbrtache / $perpage);
if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpages)) {
 $cpage = $_GET['p'];
} else {
 $cpage = 1;
}
$req = "SELECT * from `tache` where REFPROJET=" . $id_projet . " LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
$res = $conn->query($req);
?>
<div id="content" class="afftach">
  <div class="content-wrapper"><a href="ajout_tache.php?id_projet=<?php echo $id_projet; ?>"
      class="btn btn-primary">Ajout D'une Tâche</a></div>
  <div class="menubar f">
    <div class="page-title">
      <h4><strong>Liste Des Tâches Du Projet &sdot;<span class="colo"><?php echo $n; ?></span>&sdot;</strong></h4>
    </div>
  </div>
  <div class="content-wrapper">
    <?php if ($nb['Nb'] != 0) { ?>
    <table class="table table-hover ta">
      <thead>
        <tr>
          <th>Tâche</th>
          <th>Description</th>
          <th>Nombre d'heures</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $res->fetch_assoc()) { ?>
        <tr>
          <td>
            <?php if (strlen($r['Nom']) < 10) {echo $r['Nom'];} else {echo mb_substr($r['Nom'], 0, 10, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php if (strlen($r['Desc_Tache']) < 50) {echo $r['Desc_Tache'];} else {echo mb_substr($r['Desc_Tache'], 0, 50, 'UTF-8') . " ...";} ?>
          </td>
          <td><?php echo $r['Nbr_Heurs']; ?></td>
          <td><a href="lire.php?id_tache=<?php echo $r['ID'] . "&id_projet=" . $id_projet . "&p=" . $_GET['p']; ?>"
              class="btn btn-primary">Lire</a>
            <a href="modifier_tache.php?id_tache=<?php echo $r['ID']; ?>" class="btn btn-info">Modifier</a>
            <a href="supprimer.php?id_tache=<?php echo $r['ID']; ?>" class="btn btn-danger">Supprimer</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nb['Nb'] > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>>
          <a
            href="affichage_taches.php?id_projet=<?php echo $id_projet; ?>&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>">
            <span>&laquo;</span>
          </a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_taches.php?id_projet=<?php echo $id_projet; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_taches.php?id_projet=<?php echo $id_projet; ?>&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nb['Nb'] >= 1) and ($nb['Nb'] <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="affichage_taches.php?id_projet=<?php echo $id_projet; ?>&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpages; $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_taches.php?id_projet=<?php echo $id_projet; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_taches.php?id_projet=<?php echo $id_projet; ?>&p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il n'ya Aucune Tâche à ce moment.</a></div>";} ?>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>