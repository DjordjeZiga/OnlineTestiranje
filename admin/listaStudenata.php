<?php
session_start();
if(!array_key_exists("email", $_SESSION)){
	header( "Location: ../index.php" );
}
if($_SESSION["tip"] == 2){
	header( "Location: ../student/studentPredmeti.php" );
}
if($_SESSION["tip"] == 3){
	header( "Location: ../predavac/predavacPredmeti.php" );
}
header('Content-Type: text/html; charset=utf-8');
?>
<html>
	<head>
		 <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		 <link rel="stylesheet" type="text/css" href="custom.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-theme.min.css">
		<script src="../bootstrap/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="custom-bootstrap-menu" class="navbar navbar-inverse " role="navigation">
		    <div class="container-fluid">
		        <div class="navbar-header"><a class="navbar-brand" href="listaPredavaca.php">Administrator sistema</a>
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button>
		        </div>
		        <div class="collapse navbar-collapse navbar-menubuilder">
		            <ul class="nav navbar-nav navbar-left">
		                <li><a href="listaPredavaca.php">Predavači</a>
		                </li>
		                <li class="active"><a href="listaStudenata.php">Studenti</a>
		                </li>
		                <li><a href="listaPredmeta.php">Predmeti</a>
		                </li>
		            </ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../skripte/logout.php">Odjava</a>
						</li>
					</ul>
		        </div>
		    </div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="text-primary">Studenti</h3>
				</div>
			</div>
			<div class="alert alert-danger" id="err">
  				<strong>Doslo je do greske!</strong> Proverite unete podatke.
			</div>			
			<div class="row">
				<div class="col-lg-8">
					<table class="table table-hover">
						<tr>
							<th>Broj indeksa</th>
							<th>Ime</th>
							<th>Prezime</th>
							<th>E-Mail</th>
							<th>Smer</th>
						</tr>
						<?php 
						$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");

						$query = "SELECT id, ime, prezime, email, smer FROM studenti"; //You don't need a ; like you do in SQL
						$result = mysqli_query($connection, $query);


						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
						print "<tr> <td>";
				        echo $row[0];
				        print "</td> <td>";
				        echo $row[1]; 
				        print "</td> <td>";
				        echo $row[2]; 
				        print "</td> <td>";
				        echo $row[3]; 
				        print "</td> <td>";
						echo $row[4];
						print "</td> </tr>";
						}

						mysqli_close($connection); //Make sure to close out the database connection
					?>
					</table>
				</div>
				<div class="col-lg-4">
					<form action="../skripte/dodajStudenta.php" method="post" class="form" id="frm">
						<fieldset class="form-group">
							<label for="id">Broj indeksa</label>
							<input type="text" class="form-control in" id="id" placeholder="Broj indeksa" name="id"></input>
						</fieldset>
						<fieldset class="form-group">
							<label for="ime">Ime</label>
							<input type="text" class="form-control in" id="ime" placeholder="Ime" name="ime"></input>
						</fieldset>
						<fieldset class="form-group">
							<label for="prezime">Prezime</label>
							<input type="text" class="form-control in" id="prezime" placeholder="Prezime" name="prezime"></input>
						</fieldset>
						<fieldset class="form-group">
							<label for="smer">Smer</label>
							<input type="text" class="form-control in" id="smer" placeholder="Smer" name="smer"></input>
						</fieldset>
						<fieldset class="form-group">
							<label for="email">E-Mail</label>
							<input type="text" class="form-control in" id="email" placeholder="E-Mail" name="email"></input>
						</fieldset>
						<fieldset class="form-group">
							<label for="mesto_rodjenja">Adresa</label>
							<input type="text" class="form-control in" id="mesto_rodjenja" placeholder="Adresa stanovanja" name="mesto_rodjenja"></input>
						</fieldset>
						<fieldset class="form-group">
							<label for="datum_rodjenja">Datum rođenja (gggg-mm-dd)</label>
							<input type="text" class="form-control in" id="datum_rodjenja" placeholder="Datum rodjenja" name="datum_rodjenja"></input>
						</fieldset>
						<fieldset class="form-group">
							<button type="button" class="btn btn-primary" id="dugme">Dodaj studenta</button>	
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#err").hide();
			});

			$("#dugme").click(function(){
				var datum_rodjenja = $("#datum_rodjenja");
				var tacan;
				var ime = $("#ime");
				var prezime = $("#prezime");
				var email = $("#email");
				var id = $("#id");
				var mesto_rodjenja = $("#mesto_rodjenja");
				var smer = $("#smer");

				datum_rodjenja = datum_rodjenja.val();
				var list = datum_rodjenja.split('-');
				if(list[0].length == 4 && list[1].length==2 && list[1] <13 && list[2].length==2 && list[2] <32){
					tacan = true;
				} else {
					tacan = false;
				}
				if(list.length != 3){
					tacan=false;
				}
				if(tacan && ime!="" && prezime!="" && email!="" && id!="" && mesto_rodjenja!="" && smer!=""){
					$("#frm").submit();
				} else {
					$("#err").show();
				}
			});
		</script>
	</body>
</html>