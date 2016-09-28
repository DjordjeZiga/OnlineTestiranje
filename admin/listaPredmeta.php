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
		                <li><a href="listaPredavaca.php">Predavači</a>
		                </li>
		                <li><a href="listaStudenata.php">Studenti</a>
		                </li>
		                <li class="active"><a href="listaPredmeta.php">Predmeti</a>
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
					<h3 class="text-primary">Predmeti</h3>
				</div>
			</div>
			<div class="alert alert-danger" id="err">
  				<strong>Došlo je do greške!</strong> Proverite unete podatke.
			</div>
			<div class="row">
				<div class="col-lg-8">
					<table class="table table-hover">
						<tr>
							<th>ID predmeta</th>
							<th>Naziv predmeta</th>
							<th>Smer</th>
						</tr>
						<?php
						$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");

						$query = "SELECT id_predmeta,naziv,smer FROM predmeti ORDER BY naziv ASC"; //You don't need a ; like you do in SQL
						$result = mysqli_query($connection, $query);

						while($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
							print "<tr> <td>";
							echo $row[0];
							print "</td> <td>";
							echo "<a href='dodajPredmetStP.php?id_predmeta=$row[0]'>".$row[1]."</a>";
							print "</td> <td>";
							echo $row[2];
							print "</td> </tr>";
						}
						mysqli_close($connection); //Make sure to close out the database connection
					?>
					</table>
				</div>
				<div class="col-lg-4">
					<form action="../skripte/dodajPredmet.php" method="post" class="form" id="frm">
						<fieldset class="form-group">
							<label for="naziv">Naziv predmeta</label>
							<input type="text" class="form-control in" id="naziv" placeholder="Naziv predmeta" name="naziv" />
						</fieldset>
						<fieldset class="form-group">
							<label for="smer">Smer</label>
							<input type="text" class="form-control in" id="smer" placeholder="Smer" name="smer" />
						</fieldset>
						<fieldset class="form-group">
							<button type="button" class="btn btn-primary" id="dugme">Dodaj predmet</button>	
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
				var naziv = $("#naziv");
				var smer = $("#smer");

				if(naziv!="" && smer!=""){
					$("#frm").submit();
				} else {
					$("#err").show();
				}
			});
		</script>
	</body>
</html>
