<?php
$title         = "Affichage Tâches";
$EmployeNavbar = "";
include 'init.php';
if ($_SESSION['Email_Emp']) {
 $id_projet           = $_GET['id_projet'];
 $req_liste_tache     = "select * from `tache` where REFPROJET=" . $id_projet . ";";
 $res1                = $conn->query($req_liste_tache);
 $req9                = "select count(*) as nb9 from `tache` where REFPROJET=" . $id_projet . ";";
 $res9                = $conn->query($req9);
 $nb9                 = $res9->fetch_assoc();
 $req_liste_projet    = "select * from `projet` where id_projet=" . $id_projet . ";";
 $res                 = $conn->query($req_liste_projet);
 $req_liste_emp_tache = "select * from tache where REFEMPLOYE=" . $_SESSION['ID_EMPLOYE'] . " and REFPROJET=" . $_GET['id_projet'] . " and etat_aff=1";
 $rlep                = $conn->query($req_liste_emp_tache);
 $req_negoc           = "select * from tache where etat_negoc=1 and REFEMPLOYE=" . $_SESSION['ID_EMPLOYE'] . " and REFPROJET=" . $_GET['id_projet'];
 $resneg              = $conn->query($req_negoc);
 $req5                = "SELECT count(*) as Nb FROM tache where etat_aff=1 And REFEMPLOYE=" . $_SESSION['ID_EMPLOYE'] . " and REFPROJET=" . $_GET['id_projet'];
 $res5                = $conn->query($req5);
 $nb                  = $res5->fetch_assoc();
 $req6                = "SELECT count(*) as Nb1 FROM tache where etat_negoc=1 And etat_aff=0 And REFEMPLOYE=" . $_SESSION['ID_EMPLOYE'] . " and REFPROJET=" . $_GET['id_projet'];
 $res6                = $conn->query($req6);
 $nb1                 = $res6->fetch_assoc();
 ?>
<div id="content">
  <div class="content-wrapper"><a href="affichage_projet_emp.php?p=1" class="btn btn-primary">Liste Des Projets</a>
  </div>
  <div class="menubar">
    <div class="page-title">
      <strong>Liste Des Tâches Du Projet <span
          class="colo"><?php while ($r = $res->fetch_assoc()) {echo $r['Nom_Proj'];} ?></span></strong>
    </div>
  </div>
  <div class="content-wrapper aff2">
    <h4>Liste De Mes Tâches
      <!--<i class="glyphicon glyphicon-minus"></i>-->
    </h4>
    <?php if ($nb['Nb'] != 0) {
  ?>
    <table class="table ta">
      <thead>
        <tr>
          <th>Nom du tâche</th>
          <th>Description du tâche</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r2 = $rlep->fetch_assoc()) {
   $reqcr  = "select count(*) as gfg from compte_rendu where REFEMPLOYE = " . $_SESSION['ID_EMPLOYE'] . " and REFTACHE=" . $r2['ID'];
   $rescr  = $conn->query($reqcr);
   $r66    = $rescr->fetch_assoc();
   $reqcr1 = "select * from compte_rendu where REFEMPLOYE = " . $_SESSION['ID_EMPLOYE'] . " and REFTACHE=" . $r2['ID'];
   $rescr1 = $conn->query($reqcr1);
   $r661   = $rescr1->fetch_assoc();
   ?>
        <tr
          <?php if ($r661['Etat'] == 1) {echo 'class="success"';} ?><?php if ($r661['Etat'] == 2) {echo 'class="danger"';} ?>>
          <td>
            <?php if (strlen($r2['Nom']) < 10) {echo $r2['Nom'];} else {echo mb_substr($r2['Nom'], 0, 10, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php if (strlen($r2['Desc_Tache']) < 50) {echo $r2['Desc_Tache'];} else {echo mb_substr($r2['Desc_Tache'], 0, 30, 'UTF-8') . " ...";} ?>
          </td>
          <td><a href="lire.php?id_tache=<?php echo $r2['ID'] . "&s=emp&id_projet=" . $id_projet; ?>"
              class="btn btn-primary">Lire</a><a
              href="compte_rendu.php?id_tache=<?php echo $r2['ID'] . "&id_projet=" . $id_projet; ?>" class="btn btn-success"
              <?php if ($r661['Etat'] == 1) {echo "disabled";} ?>>Compte Rendu</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>J'ai Aucune tâche à ce moment.</a></div>";} ?>
    <h4>Liste De Tâches En Attente D'affectation
      <!--<i class="glyphicon glyphicon-minus"></i>-->
    </h4>
    <?php if ($nb1['Nb1'] != 0) {
  ?>
    <table class="table ta">
      <thead>
        <tr>
          <th>Nom du tâche</th>
          <th>Description du tâche</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r3 = $resneg->fetch_assoc()) {
   ?>
        <tr>
          <td>
            <?php if (strlen($r3['Nom']) < 10) {echo $r3['Nom'];} else {echo mb_substr($r3['Nom'], 0, 10, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php if (strlen($r3['Desc_Tache']) < 50) {echo $r3['Desc_Tache'];} else {echo mb_substr($r3['Desc_Tache'], 0, 30, 'UTF-8') . " ...";} ?>
          </td>
          <td><a href="lire.php?id_tache=<?php echo $r3['ID'] . "&s=emp&id_projet=" . $id_projet; ?>"
              class="btn btn-primary">Lire</a><a href="Supp_negoc.php?id_tache=<?php echo $r3['ID']; ?>"
              class="btn btn-danger">Supprimer Négociation</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>J'ai Aucune tâche Négocié à ce moment.</a></div>";} ?>
    <h4>Liste De Tous Les Tâches Du Projet
      <!--<i class="glyphicon glyphicon-minus"></i>-->
    </h4>
    <?php if ($nb9['nb9'] != 0) {
  ?>
    <table class="table ta">
      <thead>
        <tr>
          <th>Nom du tâche</th>
          <th>Description du tâche</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r1 = $res1->fetch_assoc()) {
   ?>
        <tr>
          <td>
            <?php if (strlen($r1['Nom']) < 10) {echo $r1['Nom'];} else {echo mb_substr($r1['Nom'], 0, 10, 'UTF-8') . " ...";} ?>
          </td>
          <td>
            <?php if (strlen($r1['Desc_Tache']) < 50) {echo $r1['Desc_Tache'];} else {echo mb_substr($r1['Desc_Tache'], 0, 30, 'UTF-8') . " ...";} ?>
          </td>
          <td><a href="lire.php?id_tache=<?php echo $r1['ID'] . "&s=emp&id_projet=" . $id_projet; ?>"
              class="btn btn-primary">Lire</a><a href="Negoc_tache_emp.php?id_tache=<?php echo $r1['ID']; ?>"
              class="btn btn-warning <?php if (($r1['etat_negoc'] == 1) || ($r1['etat_aff'] == 1)) {echo "disabled";} ?>">Négocier</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } else {echo "<div class='alert alert-info' role='alert'><a href='#' class='alert-link'>Ily'a Aucune tâche pour ce projet à ce moment.</a></div>";} ?>
  </div>
  <?php

 include $tpl . "footer.php";
}
?>