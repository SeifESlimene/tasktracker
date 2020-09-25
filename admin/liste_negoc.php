<?php
    $title = 'Liste De Négocations';
    include 'init.php';
?>
<?php
    $perpage   = 6;
    $cpage     = 1;
    $req5      = 'SELECT count(*) as Nb from tache where etat_negoc=1';
    $res5      = $conn->query($req5);
    $nb        = $res5->fetch_assoc();
    $nbrprojet = $nb['Nb'];
    $nbrpages  = ceil($nbrprojet / $perpage);
    if ((isset($_GET['p'])) and ($_GET['p'] >= 1) and ($_GET['p'] <= $nbrpages)) {
        $cpage = $_GET['p'];
    } else {
        $cpage = 1;
    }
    $req = 'SELECT Nom_Proj, t.Nom as nom_tache, email, image, Desc_Tache, t.ID as id_tache, etat_aff from tache as t join personne as p join projet as pr where t.REFEMPLOYE=p.ID and t.REFPROJET=pr.id_projet and etat_negoc=1 LIMIT ' . (($cpage - 1) * $perpage) . ', ' . $perpage;
    $res = $conn->query($req);
    // var_dump($req);
?>
<div id="content" class="neg">
  <div class="menubar">
    <div class="page-title">
      <h3><strong>Liste Des Négociations De Tâches Avec Les Employés</strong></h3>
    </div>
  </div>
  <div class="content-wrapper">
    <?php if ($nb['Nb'] != 0) {?>
    <table class="table table-hover ba">
      <thead>
        <tr>
          <th>Employé</th>
          <th>Adresse Email</th>
          <th>Projet</th>
          <th>Tâche Négociée</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $res->fetch_assoc()) {?>
        <tr>
          <td>
            <?php if ($r['image'] == 'Client') {echo "<img src='../" . $images . "/Client.png' width='50px' height='50px'/>";} elseif ($r['image'] == 'Employé') {echo "<img src='../" . $images . "/Employe.png' width='50px' height='50px'/>";} else {echo "<img src='../data/uploads/" . $r['image'] . "' width='50px' height='50px'/>";}?>
          </td>
          <td><?php echo $r['email']; ?></td>
          <td><?php echo $r['Nom_Proj']; ?></td>
          <td><?php echo $r['nom_tache']; ?></td>
          <td><a href="Affectation_tache_employe.php?id_tache=<?php echo $r['id_tache'] . '&p=' . $_GET['p']; ?>"
              class="btn btn-info                                  <?php if ($r['etat_aff'] == 1) {echo 'disabled';}?>">Affecter</a>
            <a href="supprimer.php?id_tache_negoc=<?php echo $r['id_tache']; ?>" class="btn btn-danger">Supprimer</a>
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <?php if ($nb['Nb'] > $perpage * 4) {?>
    <nav>
      <ul class="pagination">
        <li            <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}}?>><a
            href="liste_negoc.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo '1';}}?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = max(1, $cpage - 4); $i <= max(5, $cpage); $i++) {?>
        <li<?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}}?>><a
            href="liste_negoc.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php }?>
        <li<?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}}?>><a
            href="liste_negoc.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}}?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php }?>
<?php if (($nb['Nb'] >= 1) and ($nb['Nb'] <= $perpage * 4)) {?>
    <nav>
      <ul class="pagination">
        <li            <?php if (isset($_GET['p'])) {if ($_GET['p'] == 1) {echo "class='disabled'";}}?>><a
            href="liste_negoc.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] >= 2) {echo ($_GET['p'] - 1);} else {echo '1';}}?>"><span>&laquo;</span></a>
        </li>
        <?php for ($i = 1; $i <= $nbrpages; $i++) {?>
        <li<?php if (isset($_GET['p'])) {if ($_GET['p'] == $i) {echo "class='active'";}}?>><a
            href="liste_negoc.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php }?>
        <li<?php if (isset($_GET['p'])) {if ($_GET['p'] == $nbrpages) {echo "class='disabled'";}}?>><a
            href="liste_negoc.php?p=<?php if (isset($_GET['p'])) {if ($_GET['p'] <= $nbrpages - 1) {echo ($_GET['p'] + 1);} else {echo $nbrpages;}}?>"><span>&raquo;</span></a>
        </li>
      </ul>
    </nav>
    <?php }?>
<?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Il n'ya aucune négociation à ce moment.</a></div>";}?>
  </div>
</div>
<?php include $tpl . 'footer.php';?>