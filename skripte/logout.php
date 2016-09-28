<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["tip"]);
header( "Location: ../index.php" );
?>