<div id="sidebar-dark">
  <div class="current-user">
    <a href="#" class="name">
      <img alt="1" class="avatar" src="<?php echo $imageclient; ?>" />
      <span> Client </span>
    </a>
  </div>
  <div class="menu-section">
    <h3>Affichage</h3>
    <ul>
      <li class="option">
        <a href="Espace_Client.php" class="sidebar">
          <i class="fa fa-home"></i>
          <span>Accueil</span>
        </a>
      </li>
      <li class="option">
        <a href="Affichage_Projet_Client.php?p=1">
          <i class="fa fa-tasks"></i>
          <span>Liste Des Projets</span>
        </a>
      </li>
    </ul>
    <h3>Mon Compte</h3>
    <ul>
      <li class="option">
        <a href="Profil_Client.php" class="sidebar">
          <i class="fa fa-edit"></i>
          <span>Mon Profil</span>
        </a>
      </li>
      <li class="option">
        <a href="LogOut_Cli.php" class="sidebar">
          <i class="fa fa-sign-out"></i>
          <span>Déconnexion</span>
        </a>
      </li>
    </ul>
    <h3>Administration</h3>
    <ul>
      <li class="option">
        <a href="Contact_Client.php">
          <i class="fa fa-envelope-o"></i>
          <span>Contact</span>
        </a>
      </li>
    </ul>
  </div>
</div>