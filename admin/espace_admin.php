<?php
$title   = "Espace Administrateur";
$BodyAtt = "id = 'dashboard' class = 'admin'";
include 'init.php';
?>
<?php
$req  = 'select count(*) from client';
$q    = $conn->query($req);
$r    = $q->fetch_assoc();
$a    = $r;
$req2 = 'select count(*) from employe';
$q2   = $conn->query($req2);
$r2   = $q2->fetch_assoc();
$b    = $r2;
$req3 = 'select count(*) from projet';
$q3   = $conn->query($req3);
$r3   = $q3->fetch_assoc();
$c    = $r3;
$req4 = 'select count(*) from tache';
$q4   = $conn->query($req4);
$r4   = $q4->fetch_assoc();
$d    = $r4;
?>
<div id="content">
  <div class="menubar">
    <div class="page-title">
      <strong>Bienvenue <span class="home">Administrateur</span></strong>
    </div>
  </div>
  <div class="content-wrapper">
    <div class="metrics clearfix">
      <div class="metric">
        <span class="field">Nombre D'Employés</span>
        <span class="data"><i class="fa fa-tags"></i><?php echo "<br>" . $b['count(*)']; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Clients</span>
        <span class="data"><i class="fa fa-group"></i><?php echo "<br>" . $a['count(*)']; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Projets</span>
        <span class="data"><i class="fa fa-cubes"></i><?php echo "<br>" . $c['count(*)']; ?></span>
      </div>
      <div class="metric">
        <span class="field">Nombre De Tâches</span>
        <span class="data"><i class="fa fa-tasks"></i><?php echo "<br>" . $d['count(*)']; ?></span>
      </div>
    </div>
  </div>
</div>
<?php include $tpl . "footer.php"; ?>