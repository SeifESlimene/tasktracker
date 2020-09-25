<?php
session_start();
unset($_SESSION['ID_CLIENT']);
unset($_SESSION['Email_Client']);
unset($_SESSION['Pass_Client']);
unset($_SESSION['image']);
unset($_SESSION['npc']);
header('location:login_client.php');