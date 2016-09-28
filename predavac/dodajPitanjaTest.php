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
				<div class="col-lg-22">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Dodaj pitanje testu</h3>
						</div>
						<div class="panel-body">
							<form id="frm" method="post" class="form" action="../skripte/dodeliPitanjeTestu.php">
								<fieldset class="form-group">
									<label for="test">Pitanje</label>
									<select class="form-control" id="pitanje" name="fk_pitanje">
										<?php
										$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");
										$fkPredmeta=$_GET['fk_predmeta'];
										$idTesta=$_GET['id_testa'];
										$query = "SELECT pitanja.id_pitanja,pitanja.pitanje FROM pitanja 
                                                  WHERE pitanja.id_pitanja NOT IN (SELECT test_ima_pitanje.fk_pitanje FROM test_ima_pitanje WHERE test_ima_pitanje.fk_test=$idTesta) AND pitanja.fk_predmeta = $fkPredmeta"; //You don't need a ; like you do in SQL
										$result = mysqli_query($connection, $query);

										while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
											print "<option value=";
											echo $row[0];
											print ">";
											echo $row[1];
											print "</option>";
										}

										mysqli_close($connection); //Make sure to close out the database connection
										?>
									</select>
								</fieldset>
								<input hidden="true" name="fk_test" value="<?php echo "$_GET[id_testa]"; ?>" />
								<fieldset class="form-group">
									<button type="submit" class="btn btn-primary" id="dugme2">Dodeli pitanje testu</button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
		</div>
			<div class="row">
			<div class="col-lg-22">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Izgled testa</h3>
					</div>
					<div class="panel-body">
						<?php
						$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");
						$fkPredmeta=$_GET['fk_predmeta'];
						$idTesta=$_GET['id_testa'];
						$query = "SELECT pitanja.pitanje,pitanja.odg1,pitanja.odg2,pitanja.odg3,pitanja.odg4 FROM pitanja
								  INNER  JOIN test_ima_pitanje
								  ON test_ima_pitanje.fk_pitanje=pitanja.id_pitanja
								  WHERE test_ima_pitanje.fk_test=$idTesta"; //You don't need a ; like you do in SQL
						$result = mysqli_query($connection, $query);

						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
							echo $row[0];
							print "<br><input type='radio' name='$row[0]' value='$row[1]'>";
							echo $row[1];
							print "<br><input type='radio' name='$row[0]' value='$row[2]'>";
							echo $row[2];
							print "<br><input type='radio' name='$row[0]' value='$row[3]'>";
							echo $row[3];
							print "<br><input type='radio' name='$row[0]' value='$row[4]'>";
							echo $row[4];
							print "<br><br>";
						}

						mysqli_close($connection); //Make sure to close out the database connection
						?>
					</div>
				</div>
			</div>
			</div>
	</body>
</html>