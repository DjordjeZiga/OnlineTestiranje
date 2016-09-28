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
					<h3 class="text-primary">Testovi</h3>
				</div>
			</div>		
			<div class="row">
				<div class="col-lg-8">
					<table class="table table-hover">
						<tr>
							<th>ID Testa</th>
							<th>Naziv</th>
							<th>Status</th>
							<th>Predmet</th>
							<th>Datum kreiranja</th>
						</tr>
						<?php 
						$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");
						$idPredavacaPom = $_SESSION['id_profesora'];
						$query = "SELECT test.id,test.naziv,test.status_testa,predmeti.naziv,test.datum_kreiranja, test.fk_predmeta
						          FROM test
                                  INNER JOIN predmeti
                                  ON test.fk_predmeta=predmeti.id_predmeta
                                  INNER JOIN  predavaci
                                  ON test.fk_profesora=predavaci.id_profesora
                                  WHERE test.fk_profesora= $idPredavacaPom
                                  "; //You don't need a ; like you do in SQL
						$result = mysqli_query($connection, $query);


						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
						print "<tr> <td>";
				        echo $row[0];
				        print "</td> <td>";
				        echo "<a href='dodajPitanjaTest.php?id_testa=$row[0]&fk_predmeta=$row[5]'>".$row[1]."</a>";
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
				<div class="row">
				<div class="col-lg-4">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Dodaj test</h3>
						</div>
						<div class="panel-body">
							<form action="../skripte/dodajTest.php" method="post" class="form" id="frm">
								<fieldset class="form-group">
									<label for="naziv">Naziv testa</label>
									<input type="text" class="form-control in" id="naziv" placeholder="Naziv testa" name="naziv" />
								</fieldset>
								<fieldset class="form-group">
									<label for="status_testa">Status</label>
									<select class="form-control">
										<option value="Aktivan">Aktivan</option>
										<option value="Neaktivan">Neaktivan</option>
									</select>
								</fieldset>
								<fieldset class="form-group">
									<label for="fk_predmeta">Predmet</label>
									<input type="text" class="form-control in" id="fk_predmeta" placeholder="Predmet" name="fk_predmeta" />
								</fieldset>
								<fieldset class="form-group">
									<label for="datum_kreiranja">Datum kreiranja</label>
									<input type="text" class="form-control in" id="datum_kreiranja" placeholder="Datum kreiranja" name="datum_kreiranja" />
								</fieldset>
								<fieldset class="form-group">
									<input hidden="true"  name="fk_profesora" value="<?php echo "$_SESSION[id_profesora]"; ?>" />
								</fieldset>
								<fieldset class="form-group">
									<button type="submit" class="btn btn-primary" id="dugme">Dodaj test</button>
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