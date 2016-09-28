<?php
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt insert query execution
$sql = "INSERT INTO `resio_test`(`fk_student`, `fk_test`, `ocena`, `fk_predmet`) VALUES ('$_POST[stId]','$_POST[idTesta]', '$_POST[ocena]', '$_POST[fkPredmeta]')";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
header( "Location: ../student/studentPredmeti.php?id=$_POST[stId]" );
?>

