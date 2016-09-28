<?php
session_start();
if(!array_key_exists("email", $_SESSION)){
	header( "Location: ../index.php" );
}
if($_SESSION["tip"] == 1){
	header( "Location: ../admin/listaPredavaca.php" );
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
				<div class="navbar-header"><a class="navbar-brand" href="studentPredmeti.php?id=<?php echo $_SESSION["id"]?>"><?php echo $_SESSION["ime"]. " " . $_SESSION["prezime"] . " ".$_SESSION["id"] ?></a>
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button>
		        </div>
		        <div class="collapse navbar-collapse navbar-menubuilder">
		            <ul class="nav navbar-nav navbar-left">
		                <li class="active"><a href="studentPredmeti.php">Predmeti</a>
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
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Izgled testa</h3>
					</div>
					<div class="panel-body">
						<?php
						$connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");
						$fkPredmeta=$_GET['fk_predmeta'];
						$idTesta=$_GET['id_testa'];
						$query = "SELECT pitanja.pitanje,pitanja.odg1,pitanja.odg2,pitanja.odg3,pitanja.odg4, pitanja.tacan FROM pitanja
								  INNER  JOIN test_ima_pitanje
								  ON test_ima_pitanje.fk_pitanje=pitanja.id_pitanja
								  WHERE test_ima_pitanje.fk_test=$idTesta"; //You don't need a ; like you do in SQL
						$result = mysqli_query($connection, $query);
						$i = 0;
						while($row = mysqli_fetch_array($result)){
							//Creates a loop to loop through results
							$i++;
							echo $row[0];
							print "<br><input type='radio' name='$i' value='$row[1]'>";
							echo $row[1];
							print "<br><input type='radio' name='$i' value='$row[2]'>";
							echo $row[2];
							print "<br><input type='radio' name='$i' value='$row[3]'>";
							echo $row[3];
							print "<br><input type='radio' name='$i' value='$row[4]'>";
							echo $row[4];
							print "<br>";
							print "<br><input type='hidden' value='$row[5]' id='re$i'>";
						}
						print "<br><input type='hidden' value='$i' id='ukupno'>";
						mysqli_close($connection); //Make sure to close out the database connection
						?>
					</div>
				</div>
				<form id="predajTest" action="../skripte/predajTest.php" method="post">
					<input type="hidden" name="stId" value="<?php echo "$_SESSION[id]"; ?>">
					<input type="hidden" name="idTesta" value="<?php echo "$_GET[id_testa]"; ?>">
					<input type="hidden" name="fkPredmeta" value="<?php echo "$_GET[fk_predmeta]"; ?>">
					<input type="hidden" name="ocena" id="ocena">
					<button type="button" class="btn btn-danger" id="predaj">Zavrsi</button>
				</form>
			</div>
			</div>
	</body>
<script type="text/javascript">
	$('#predaj').click(function () {
		var brojPitanja = $('#ukupno').val();
		var brojTacnih = 0;
		for (var i=1; i<=brojPitanja; i++){
			var odgovor = $("[name='" + i + "']:checked").val();
			var tacanOdgovor = $("[id='re" + i + "']").val();
			if (odgovor==tacanOdgovor){
				brojTacnih++;
			}
		}
		var procenti = (brojTacnih/brojPitanja) * 100;
		var ocena = 5;
		if(procenti < 51){
			ocena = 5;
		} else if(procenti < 61){
			ocena = 6;
		}else if(procenti < 71){
			ocena = 7;
		}else if(procenti < 81){
			ocena = 8;
		}else if(procenti < 91){
			ocena = 9;
		} else {
			ocena = 10;
		}
		$('#ocena').val(ocena);
		$("#predajTest").submit();
	});
</script>
</html>