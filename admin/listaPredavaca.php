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
header('Content-Type: text/html; charset=utf-8');?>
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
		                <li class="active"><a href="listaPredavaca.php">Predavači</a>
		                </li>
		                <li><a href="listaStudenata.php">Studenti</a>
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
					<h3 class="text-primary">Predavači</h3>
				</div>
			</div>
			<div class="alert alert-danger" id="err">
  				<strong>Došlo je do greške!</strong> Proverite unete podatke.
			</div>
			<div class="row">
				<div class="col-lg-8">
					<table class="table table-hover">
						<tr>
							<th>Ime</th>
							<th>Prezime</th>
							<th>Zvanje</th>
							<th>E-Mail</th>
						</tr>
						<?php 
						$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");

						$query = "SELECT ime, prezime, zvanje, email, id_profesora FROM predavaci"; //You don't need a ; like you do in SQL
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
				        print "</td> </tr>";
						}

						mysqli_close($connection); //Make sure to close out the database connection
					?>
					</table>
				</div>
				<div class="col-lg-4">
					<form action="../skripte/dodajPredavaca.php" method="post" class="form" id="frm">
						<fieldset class="form-group">
							<label for="ime">Ime</label>
							<input type="text" class="form-control in" id="ime" placeholder="Ime" name="ime" />
						</fieldset>
						<fieldset class="form-group">
							<label for="prezime">Prezime</label>
							<input type="text" class="form-control in" id="prezime" placeholder="Prezime" name="prezime"  />
						</fieldset>
						<fieldset class="form-group">
							<label for="email">e-mail</label>
							<input type="text" class="form-control in" id="email" placeholder="e-mail" name="email" />
						</fieldset>
						<fieldset class="form-group">
							<label for="zvanje">Zvanje</label>
							<input type="text" class="form-control in" id="zvanje" placeholder="Zvanje" name="zvanje" />
						</fieldset>
						<fieldset class="form-group">
							<label for="datum_rodjenja">Datum rođenja (gggg-mm-dd)</label>
							<input type="text" class="form-control in" id="datum_rodjenja" placeholder="Datum rodjenja" name="datum_rodjenja" />
						</fieldset>
						<fieldset class="form-group">
							<button type="button" class="btn btn-primary" id="dugme">Dodaj predavača</button>
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
				var zvanje = $("#zvanje");
				datum_rodjenja = datum_rodjenja.val();
				var list = datum_rodjenja.split('-');
				if(list[0].length == 4 && list[1].length==2 && list[1] <13 && list[2].length==2 && list[2] <33){
					tacan = true;
				} else {
					tacan = false;
				}
				if(list.length != 3){
					tacan=false;
				}
				if(tacan && ime!="" && prezime!="" && email!="" && zvanje!=""){
					$("#frm").submit();
				} else {
					$("#err").show();
				}
			});
		</script>
	</body>
</html>