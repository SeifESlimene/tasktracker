<?php
    $title       = 'Accueil';
    $NoConnect   = '';
    $HeaderIntro = '';
    include 'init.php';
?>
<div class="intro-header acc fvb">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="intro-message">
          <h1>Welcome To Our Application</h1>
          <br>
          <h2>Task Tracker System</h2>
          <hr class="intro-divider">
          <ul class="list-inline intro-social-buttons">
            <li>
              <a href="login_client.php" class="btn btn-default btn-lg btn-client"><span
                  class="network-name"><b>Client</b></span></a>
            </li>
            <li>
              <a href="login_employe.php" class="btn btn-default btn-lg"><span
                  class="network-name"><b>Employé</b></span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-inline">
          <li>
            <a href="index.php">Home</a>
          </li>
          <li class="footer-menu-divider">&sdot;</li>
          <li>
            <a href="about.php">About</a>
          </li>
          <li class="footer-menu-divider">&sdot;</li>
          <li>
            <a href="contact.php">Contact</a>
          </li>
        </ul>
        <p class="copyright text-muted small"><span class="ges"><a href="index.php">Task Tracker</a></span>
          &copy; Septembre 2020</p>
      </div>
    </div>
  </div>
</footer>
<?php include $tpl . 'footer_intro.php';?>