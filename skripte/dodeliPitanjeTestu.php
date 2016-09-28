<?php
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO `test_ima_pitanje`(`fk_test`,`fk_pitanje`) VALUES ('$_POST[fk_test]','$_POST[fk_pitanje]')";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
header( "Location: ../predavac/dodajPitanjaTest.php?id_testa=$_POST[idTesta]&fk_predmeta=$_POST[fkPredmeta]" );
?>