<?php
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO `pitanja`(`pitanje`, `odg1`, `odg2`, `odg3`, `odg4`, `tacan`, `fk_profesora`, `fk_predmeta`) VALUES ('$_POST[pitanje]','$_POST[odg1]','$_POST[odg2]','$_POST[odg3]','$_POST[odg4]','$_POST[tacan]','$_POST[fk_profesora]','$_POST[fk_predmeta]')";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
header( "Location: ../predavac/listaPitanja.php?id_predmeta=$_POST[fk_predmeta]" );
?>

