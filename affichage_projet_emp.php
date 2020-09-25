<?php
$title         = "Affichage Projets";
$EmployeNavbar = "";
?>
<?php
include 'init.php';
$data            = array();
$perpage         = 5;
$cpage           = 1;
$req3            = "select count(*) As Nb from projet";
$res3            = $conn->query($req3);
$nb              = $res3->fetch_assoc();
$nbrprojetclient = $nb['Nb'];
$nbrpages        = ceil($nbrprojetclient / $perpage);
if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpages)) {
 $cpage = $_GET['p'];
} else {
 $cpage = 1;
}
$req4 = "select * from projet LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
$res1 = $conn->query($req4);
?>
<div id="content">
  <div class="content-wrapper ">
  </div>
  <div class="menubar">
    <div class="page-title">
      <strong>Liste Des Projets</strong>
    </div>
  </div>
  <div class="content-wrapper aff1">
    <?php if ($nb['Nb'] != 0) {
 ?>
    <h4>Tous Les Projets
      <!--<i class="glyphicon glyphicon-minus"></i>-->
    </h4>
    <table class="table proj">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $res1->fetch_assoc()) {
  ?>
        <tr>
          <td>
            <?php if (strlen($r['Nom_Proj']) < 45) {echo $r['Nom_Proj'];} else {echo mb_substr($r1['Nom_Proj'], 0, 45, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php if (strlen($r['Description_Proj']) < 40) {echo $r['Description_Proj'];} else {echo mb_substr($r['Description_Proj'], 0, 40, 'UTF-8') . " ...";} ?>
          </td>
          <td><a href="lire.php?id_projet=<?php echo $r['id_projet'] . "&s=emp&p=" . $_GET['p']; ?>"
              class="btn btn-primary">Lire</a>
            <a href="affichage_taches_emp.php?id_projet=<?php echo $r['id_projet']; ?>" class="btn btn-danger">Liste
              Tâches</a>
          </td>
        </tr>
        <!--<tr class="foot"><td colspan="6"><span><?php if ($r['pourcentage'] != 100) {echo ("Pas Terminé");} else {echo ("Terminé");} ?></span></td></tr>-->
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nb['Nb'] > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_emp.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_projet_emp.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_emp.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nb['Nb'] >= 1) and ($nb['Nb'] <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_emp.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpages; $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_projet_emp.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_emp.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il N'ya aucun projet à ce moment.</a></div>";} ?>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>