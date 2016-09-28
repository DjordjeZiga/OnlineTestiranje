<?php
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO `Studenti`(`id`, `ime`, `prezime`, `datum_rodjenja`, `mesto_rodjenja`, `smer`, `email`) VALUES ('$_POST[id]','$_POST[ime]','$_POST[prezime]','$_POST[datum_rodjenja]','$_POST[mesto_rodjenja]','$_POST[smer]','$_POST[email]')";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "INSERT INTO `korisnici`(`email`, `pass`, `tip`) VALUES ('$_POST[email]','123456',2)";
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
header( "Location: ../admin/listaStudenata.php" );
?>

