<div id="sidebar-dark">
  <div class="current-user">
    <a href="#" class="name">
      <img alt="Admin" class="avatar" src="<?php echo $imageAdmin; ?>" />
      <span> MS Pro </span>
    </a>
  </div>
  <div class="menu-section">
    <h3>Admin</h3>
    <ul>
      <li class="option">
        <a href="Espace_Admin.php" class="sidebar">
          <i class="fa fa-home"></i>
          <span>Accueil</span>
        </a>
      </li>
      <li class="option">
        <a href="LogOut.Php" class="sidebar">
          <i class="fa fa-sign-out"></i>
          <span>Déconnexion</span>
        </a>
      </li>
    </ul>
    <h3>Ajout</h3>
    <ul>
      <li class="option">
        <a href="Ajout_Client.php" class="sidebar">
          <i class="fa fa-user"></i>
          <span>Client</span>
        </a>
      </li>
      <li class="option">
        <a href="Ajout_Employe.php">
          <i class="fa fa-tag"></i>
          <span>Employé</span>
        </a>
      </li>
      <li class="option">
        <a href="Ajout_Projet.php">
          <i class="fa fa-tasks"></i>
          <span>Projet</span>
        </a>
      </li>
    </ul>
    <h3>Employé</h3>
    <ul>
      <li class="option">
        <a href="liste_negoc.php?p=1" class="sidebar">
          <i class="fa fa-exchange"></i>
          <span>Liste De Négocation</span>
        </a>
      </li>
      <li class="option">
        <a href="Avancement.php">
          <i class="glyphicon glyphicon-hourglass"></i>
          <span>Etat D'Avancement</span>
        </a>
    </ul>
    <h3>Autre</h3>
    <ul>
      <li class="option">
        <a href="Contact_Admin.php">
          <i class="fa fa-envelope-o"></i> <span>Contact</span>
        </a>
      </li>
    </ul>
  </div>
</div>