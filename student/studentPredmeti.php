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
            <h3 class="text-primary">Izaberite predmet</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover">
                <?php
                $connection =mysqli_connect("localhost", "root", "", "onlinetestiranje");
                $idStudentaPom = $_SESSION['id'];
                $query = "SELECT predmeti.id_predmeta,predmeti.naziv FROM predmeti
								  INNER JOIN student_slusa
								  ON student_slusa.fk_predmeta=predmeti.id_predmeta
								  WHERE student_slusa.fk_studenta= $idStudentaPom"; //You don't need a ; like you do in SQL
                $result = mysqli_query($connection, $query);


                while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                    print "<tr> <td>";
                    echo "<a href='studentTestovi.php?id_predmeta=$row[0]'>".$row[1]."</a>";
                    print "</td> </tr>";
                }

                mysqli_close($connection); //Make sure to close out the database connection
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
