<?php
session_start();
if(!array_key_exists("email", $_SESSION)){
	header( "Location: ../index.php" );
}
if($_SESSION["tip"] == 1){
	header( "Location: ../admin/listaPredavaca.php" );
}
if($_SESSION["tip"] == 2){
	header( "Location: ../student/studentPredmeti.php" );
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
		        <div class="navbar-header"><a class="navbar-brand" href="listaTesta.php?id_profesora=<?php echo $_SESSION["id_profesora"]?>"><?php echo $_SESSION["ime"]. " " . $_SESSION["prezime"] . " ".$_SESSION["id_profesora"] ?></a>
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button>
		        </div>
		        <div class="collapse navbar-collapse navbar-menubuilder">
		            <ul class="nav navbar-nav navbar-left">
		                <li class="active"><a href="listaTesta.php">Testovi</a>
		                </li>
		                <li><a href="listaPredmeta.php">Pitanja</a>
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
					<h3 class="text-primary">Pitanja</h3>
				</div>
			</div>		
			<div class="row">
				<div class="col-lg-8">
					<table class="table table-hover">
						<tr>
							<th>ID</th>
							<th>Pitanje</th>
						</tr>
						<?php 
						$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");
						$idPredavacaPom = $_SESSION['id_profesora'];
						$fkPredmeta = $_GET['id_predmeta'];
						$query = "SELECT pitanja.id_pitanja,pitanja.pitanje
						          FROM pitanja
                                  INNER JOIN predavaci
                                  ON pitanja.fk_profesora=predavaci.id_profesora
                                  WHERE pitanja.fk_profesora= $idPredavacaPom AND pitanja.fk_predmeta= $fkPredmeta
                                  "; //You don't need a ; like you do in SQL
						$result = mysqli_query($connection, $query);


						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
						print "<tr> <td>";
				        echo $row[0];
						print "</td> <td>";
						echo $row[1];
						print "</td> </tr>";
						}

						mysqli_close($connection); //Make sure to close out the database connection
					?>
					</table>
				</div>
				<div class="row">
				<div class="col-lg-4">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Dodaj pitanje</h3>
						</div>
						<div class="panel-body">
							<form action="../skripte/dodajPitanje.php" method="post" class="form" id="frm">
								<fieldset class="form-group">
									<label for="naziv">Pitanje</label>
									<input type="text" class="form-control in" id="Pitanje" placeholder="Unesite pitanje" name="pitanje" />
								</fieldset>
								<fieldset class="form-group">
									<label for="odg1">Odgovor 1</label>
									<input type="text" class="form-control in" id="odg1" placeholder="Odgovor 1" name="odg1" />
								</fieldset>
								<fieldset class="form-group">
									<label for="odg2">Odgovor 2</label>
									<input type="text" class="form-control in" id="odg2" placeholder="Odgovor 2" name="odg2" />
								</fieldset>
								<fieldset class="form-group">
									<label for="odg3">Odgovor 3</label>
									<input type="text" class="form-control in" id="odg3" placeholder="Odgovor 3" name="odg3" />
								</fieldset>
								<fieldset class="form-group">
									<label for="odg4">Odgovor 4</label>
									<input type="text" class="form-control in" id="odg4" placeholder="Odgovor 4" name="odg4" />
								</fieldset>
								<fieldset class="form-group">
									<label for="tacan">Tacan</label>

									<input type="text" class="form-control in" id="tacan" placeholder="Unesite tacan odgovor" name="tacan" />
								</fieldset>
								</fieldset>
								<input hidden="true" name="fk_predmeta" value="<?php echo $fkPredmeta; ?>" />
								<fieldset class="form-group">
								</fieldset>
								<input hidden="true" name="fk_profesora" value="<?php echo $idPredavacaPom; ?>" />
								<fieldset class="form-group">
								<fieldset class="form-group">
									<button type="submit" class="btn btn-primary" id="dugme8">Dodaj pitanje</button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</body>
</html>