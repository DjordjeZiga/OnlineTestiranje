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
		                <li  class="active"><a href="listaPredmeta.php">Predmeti</a>
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
				<div class="col-lg-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Dodeli predmet studentu</h3>
						</div>
						<div class="panel-body">
							<form id="frm" method="post" class="form" action="../skripte/dodeliPredmetStudentu.php">
								<fieldset class="form-group">
									<label for="predavac">Student</label>
									<select class="form-control" id="id" name="fk_student">
										<?php
										$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");
                                        $fkPredmeta=$_GET["id_predmeta"];
										$query = "SELECT studenti.id, studenti.ime, studenti.prezime FROM studenti
                                                  WHERE studenti.id NOT IN (SELECT student_slusa.fk_studenta FROM student_slusa WHERE student_slusa.fk_predmeta=$fkPredmeta)"; //You don't need a ; like you do in SQL
										$result = mysqli_query($connection, $query);

										while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
											print "<option value=";
											echo $row[0];
											print ">";
											echo $row[0] . " ". $row[1] . " " . $row[2];
											print "</option>";
										}

										mysqli_close($connection); //Make sure to close out the database connection
										?>
									</select>
								</fieldset>
								<input hidden="true" name="fk_predmet" value="<?php echo "$_GET[id_predmeta]"; ?>" />
								<fieldset class="form-group">
									<button type="submit" class="btn btn-primary" id="dugme2">Dodeli predmet studentu</button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Dodeli predmet predavaču</h3>
							</div>
							<div class="panel-body">
								<form method="post" class="form" action="../skripte/dodeliPredmetProfesoru.php">
									<fieldset class="form-group">
										<label for="predavac">Predavač</label>
										<select class="form-control" id="predavac" name="fk_profesora">
											<?php
											$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");

											$query = "SELECT * FROM predavaci
                                                      WHERE predavaci.id_profesora NOT IN (SELECT predavac_predaje.fk_predavaca FROM predavac_predaje WHERE predavac_predaje.fk_predmeta=$fkPredmeta)"; //You don't need a ; like you do in SQL
											$result = mysqli_query($connection, $query);

											while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
												print "<option value=";
												echo $row[0];
												print ">";
												echo $row[1] . " " . $row[2];
												print "</option>";
											}
											mysqli_close($connection); //Make sure to close out the database connection
											?>
										</select>
									</fieldset>
									<input hidden="true" name="fk_predmeta" value="<?php echo "$_GET[id_predmeta]"; ?>" />
									<fieldset class="form-group">
										<button type="submit" class="btn btn-primary" id="dugme2">Dodeli predmet predavaču</button>
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