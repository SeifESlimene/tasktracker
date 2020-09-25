<?php
$title = "Avancement Des Projets Et Tâches";
include 'init.php';
?>
<div id="content" class="avancement">
  <div class="menubar">
    <h3>Etat D'avancement Des Projets</h3>
  </div>
  <div class="content-wrapper">
    <?php
$req  = "select * from projet";
$res  = $conn->query($req);
$req4 = "select count(*) as Nbproj from projet";
$res4 = $conn->query($req4);
$r4   = $res4->fetch_assoc();
if ($r4['Nbproj'] != 0) {
 while ($r = $res->fetch_assoc()) {
  $req1  = "select * from tache where REFPROJET=" . $r['id_projet'] . " and etat_aff=1";
  $res1  = $conn->query($req1);
  $req5  = "select count(*) as Nbrtache from tache where etat_aff=1 and REFPROJET=" . $r['id_projet'];
  $res5  = $conn->query($req5);
  $r5    = $res5->fetch_assoc();
  $req6  = "SELECT SUM(pourcentage) AS percproj FROM tache where REFPROJET=" . $r['id_projet'];
  $res6  = $conn->query($req6);
  $r6    = $res6->fetch_assoc();
  $req10 = "SELECT count(*) AS nbrtache FROM tache where REFPROJET=" . $r['id_projet'];
  $res10 = $conn->query($req10);
  $r16   = $res10->fetch_assoc();
  if ($r5['Nbrtache'] != 0) {
   ?>
    <div class="aprojet">
      <header>
        <div class="Nomproj"><?php echo ($r['Nom_Proj']); ?></div>
        <div class="pourproj">
          <span><?php if ($r16['nbrtache'] != 0) {echo ceil($r6['percproj'] / $r16['nbrtache']) . "%";} else {echo '0%';} ?></span>
        </div>
      </header>
      <?php if ($r5['Nbrtache'] != 0) {
    ?>
      <section>
        <table class="table table-condensed table-hover">
          <thead>
            <tr>
              <th>Tâche</th>
              <th>Employé</th>
              <th>Pourcentage</th>
              <th>Nombre d'heures</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
while ($r1 = $res1->fetch_assoc()) {
     $req2 = "select Nom, Prenom, ID from personne where ID=" . $r1['REFEMPLOYE'];
     $res2 = $conn->query($req2);
     $r2   = $res2->fetch_assoc();
     $req3 = "select count(*) as Nbr from compte_rendu where REFTACHE=" . $r1['ID'] . " and REFEMPLOYE=" . $r2['ID'];
     $res3 = $conn->query($req3);
     $r3   = $res3->fetch_assoc();
     $req8 = "select * from compte_rendu where REFTACHE=" . $r1['ID'] . " and REFEMPLOYE=" . $r2['ID'];
     $res8 = $conn->query($req8);
     $r8   = $res8->fetch_assoc();
     ?>
            <tr
              <?php if ($r8['Etat'] == 1) {echo 'class="success"';} ?><?php if ($r8['Etat'] == 2) {echo 'class="danger"';} ?>>
              <td><?php echo $r1['Nom']; ?></td>
              <td><?php echo $r2['Nom'] . " " . $r2['Prenom']; ?></td>
              <td>
                <div class="progress text-center">
                  <div class="progress-bar progress-bar-success progress-bar-striped"
                    style="width: <?php echo $r1['pourcentage'] . "%"; ?>">
                    <span><?php echo $r1['pourcentage'] . "%"; ?></span>
                  </div>
                </div>
              </td>
              <td><?php echo $r1['Nbr_Heurs']; ?></td>
              <td>
                <a href="supprimer.php?id_tache_negoc=<?php echo $r1['ID']; ?>"
                  class="btn btn-danger <?php if ($r1['pourcentage'] == 100) {echo 'disabled';} ?>">Retirer
                  L'affectation</a>
                <a href="compte_rendu.php?idcompterendu=<?php echo $r8['ID_compterendu']; ?>" class="btn btn-success <?php if ($r3['Nbr'] == 0) {echo "disabled";}if ($r1['pourcentage'] == 100) {echo 'disabled';}
     ?>">Voir Compte Rendu</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </section>
      <?php } else {echo "<div class='alert alert-info text-center' role='alert'><a href='#' class='alert-link'>Il N'ya Aucune Tâche Affecté Pour Ce Projet à ce moment.</a></div>";} ?>
    </div>
    <?php } ?>
    <?php }} else {echo "<div class='alert alert-info text-center' role='alert'><a href='#' class='alert-link'>Il N'ya Aucune Projet à ce moment.</a></div>";} ?>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>