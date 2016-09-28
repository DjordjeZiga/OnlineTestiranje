<?php
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO `test`(`naziv`,`status_testa`,fk_predmeta,datum_kreiranja,fk_profesora) VALUES ('$_POST[naziv]','$_POST[status_testa]','$_POST[fk_predmeta]','$_POST[datum_kreiranja]','$_POST[fk_profesora]')";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
header( "Location: ../predavac/listaTesta.php" );
?>

