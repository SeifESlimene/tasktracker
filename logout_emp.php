<?php
session_start();
unset($_SESSION['ID_EMPLOYE']);
unset($_SESSION['Email_Emp']);
unset($_SESSION['Pass_Emp']);
unset($_SESSION['imageemp']);
unset($_SESSION['npe']);
header('location:login_employe.php');