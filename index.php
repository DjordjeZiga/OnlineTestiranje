<?php
session_start();
?>
<html>
	<head>
		 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		 <link rel="stylesheet" type="text/css" href="custom.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
		<script src="bootstrap/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="login-container">
				<div id="output"></div>
				<div class="avatar"></div>
				<div class="form-box">
					<form method="post" class="form" action="skripte/login.php">
						<input type="text" name="email" id="email" placeholder="E-mail">
						<input  type="password" name="password" id="password" placeholder="Lozinka">
						<button class="btn btn-primary btn-block login" id="dugme" type="submit">Prijavi se</button>
					</form>
				</div>
			</div>

		</div>
	</body>
</html>