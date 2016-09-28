<?php
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO predavaci(ime, prezime, datum_rodjenja, zvanje, email) VALUES ('$_POST[ime]','$_POST[prezime]','$_POST[datum_rodjenja]','$_POST[zvanje]','$_POST[email]')";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "INSERT INTO `korisnici`(`email`, `pass`, `tip`) VALUES ('$_POST[email]','123456',3)";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
header( "Location: ../admin/listaPredavaca.php" );
?>


