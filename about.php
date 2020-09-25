<?php
    $title       = 'Qui Somme-Nous?';
    $HeaderIntro = '';
    $NoConnect   = '';
    include 'init.php'
;?>
<div id="wrap">
  <div class="apro intro-header aprop">
    <div class="row1">
      <div class="intro-message">
        <h1>Who Are We</h1>
        <hr class="intro-divider1">
      </div>
    </div>
    <div class="row">
      <div class="thumbnail1 p1 col-lg-6">
        <div class="tr2">
          <img class="img-thumbnail" width="250" height="250" src="layout/images/p1.jpg">
          <div class="caption1">
            <h3>Seif Eddine Slimene</h3>
            <p>
              <a href="https://www.linkedin.com/in/seifeslimene" class="btn btn-linkedin" target="_blank">Linkedin</a>
              <a href="https://www.github.com/seifeslimene" class="btn btn-github" target="_blank">Github</a>
            </p>
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
</div>
<?php include $tpl . 'footer_intro.php';?>