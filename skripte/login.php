<?php 
session_start();
$link = mysqli_connect("localhost", "root", "", "onlinetestiranje");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT * FROM korisnici WHERE email = '$_POST[email]' AND pass = '$_POST[password]'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
if($row == null) {
	header( "Location: ../index.php" );
} else {
	$_SESSION['email'] = $row[0];
	$_SESSION['tip'] = $row[2];
	if($row[2] == 1) {
		header( "Location: ../admin/listaPredavaca.php" );
	} elseif ($row[2] == 2) {
		$sql = "SELECT studenti.id, studenti.ime, studenti.prezime FROM studenti WHERE email = '$_SESSION[email]'";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($result);
		$_SESSION['id'] = $row[0];
		$_SESSION['ime'] = $row[1];
		$_SESSION['prezime'] = $row[2];
		header( "Location: ../student/studentPredmeti.php" );
	} else {
		$sql = "SELECT predavaci.id_profesora, predavaci.ime, predavaci.prezime FROM predavaci WHERE email = '$_SESSION[email]'";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($result);
		$_SESSION['id_profesora'] = $row[0];
		$_SESSION['ime'] = $row[1];
		$_SESSION['prezime'] = $row[2];
		header( "Location: ../predavac/listaTesta.php" );
	}
}

?>