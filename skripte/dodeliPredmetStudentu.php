<?php
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO student_slusa(fk_studenta, fk_predmeta) VALUES ('$_POST[fk_student]','$_POST[fk_predmet]')";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
header( "Location: ../admin/dodajPredmetStP.php?id_predmeta='$_POST[fk_predmeta]''" );
?>