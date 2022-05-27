<?php
session_start();
unset($_SESSION['pseudo']);
unset($_SESSION['password']);
unset($_SESSION['id']);
session_destroy();
header("Location:login.php");
?>