<?php
session_start();
if(!array_key_exists("email", $_SESSION)){
    header( "Location: ../index.php" );
}
if($_SESSION["tip"] == 1){
    header( "Location: ../admin/listaPredavaca.php" );
}
if($_SESSION["tip"] == 2){
    header( "Location: ../student/studentPredmeti.php" );
}
header('Content-Type: text/html; charset=utf-8');
?>