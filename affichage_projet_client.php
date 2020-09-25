<?php
$title        = "Affichage De Projets";
$ClientNavbar = "";
include 'init.php';
$perpage         = 5;
$cpage           = 1;
$req1            = "select * from projet where Refclient = " . $_SESSION['ID_CLIENT'];
$res1            = $conn->query($req1);
$req3            = "select count(*) as nbrproj from projet where Refclient = " . $_SESSION['ID_CLIENT'];
$res3            = $conn->query($req3);
$r3              = $res3->fetch_assoc();
$req5            = "SELECT count(*) as Nb FROM projet where Refclient = " . $_SESSION['ID_CLIENT'];
$res5            = $conn->query($req5);
$nb              = $res5->fetch_assoc();
$nbrprojetclient = $nb['Nb'];
$nbrpages        = ceil($nbrprojetclient / $perpage);
if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpages)) {
 $cpage = $_GET['p'];
} else {
 $cpage = 1;
}
$req4 = "SELECT * FROM projet where Refclient = " . $_SESSION['ID_CLIENT'] . " LIMIT " . (($cpage - 1) * $perpage) . ", " . $perpage;
$res4 = $conn->query($req4);
?>
<div id="content" class="apc-2016">
  <div class="menubar">
    <div class="page-title">
      <strong>Affichage Des Projets</strong>
    </div>
  </div>
  <div class="content-wrapper aff2">
    <?php if ($nb['Nb'] != 0) {
 ?>
    <h4> Vous Avez <span><?php echo $r3['nbrproj']; ?></span> Projets </h4>
    <table class="table proj table-hover">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Pourcentage</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r1 = $res4->fetch_assoc()) {
  ?>
        <tr>
          <td>
            <?php if (strlen($r1['Nom_Proj']) < 45) {echo $r1['Nom_Proj'];} else {echo mb_substr($r1['Nom_Proj'], 0, 45, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php if (strlen($r1['Description_Proj']) < 25) {echo $r1['Description_Proj'];} else {echo mb_substr($r1['Description_Proj'], 0, 25, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php $req88 = "select sum(pourcentage) as projter from tache where REFPROJET = " . $r1['id_projet'];
  $q88                     = $conn->query($req88);
  $rr5                     = $q88->fetch_assoc();
  $req10                   = "SELECT count(*) AS nbrtache FROM tache where REFPROJET=" . $r1['id_projet'];
  $res10                   = $conn->query($req10);
  $r16                     = $res10->fetch_assoc();
   if($r16['nbrtache'] != 0) {
    echo ceil($rr5['projter'] / $r16['nbrtache']) . "%";
  } 
  else {
    echo '0%';
  }
  ?>
          </td>
          <td><a href="lire.php?id_projet=<?php echo $r1['id_projet'] . "&s=cli&p=" . $_GET['p']; ?>"
              class="btn btn-primary">Lire</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($nb['Nb'] > $perpage * 4) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_client.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_projet_client.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_client.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php if (($nb['Nb'] >= 1) and ($nb['Nb'] <= $perpage * 4)) { ?>
    <nav>
      <ul class="pagination">
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_client.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo "1";}} ?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpages; $i++) { ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}} ?>><a
            href="affichage_projet_client.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li <?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}} ?>><a
            href="affichage_projet_client.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}} ?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Vous avez aucun projet à ce moment.</a></div>";} ?>
  </div>
</div>

<?php include $tpl . "footer.php"; ?>