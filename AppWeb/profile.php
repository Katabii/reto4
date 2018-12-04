<?php
include('session.php');
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Secure credit card management</title>
		<link rel="stylesheet" href="css/estilos.css"/>
		<meta charset="utf-8" />
		<meta name="description" content="Reto 3 Maristak"/>
		<meta name="keywords" content="HTML5, CSS3"/>
		<!-- Para aplicaciones móviles -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<meta name="keywords" content="Flat Login Form Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<!-- //Para aplicaciones móviles -->
	</head>
	<body>
		<header>
			<figure>
				<img src="images/logowebfull.jpg" alt="logo analphabet" width="1700" height="450">
			</figure>
		</header>
		<section>
			<div class="header agile">
				<div class="wrap">
					<div class="login-main wthree">
						<div class="login">
							<h3>Bienvenid@ al sistema  <i><?php echo $login_session; ?></i></h3>	
							<div class="clear"> </div>
								<h4><a href="logout.php"> Cerrar sesión</a></h4>
							</div>
						</div>
					</div>
				</div>
		</section>
		<footer>
			<div class="copy-rights w3l">		 	
				<p>© <?php echo date("Y");?> <a href="https://analphabet.org/" target="_blank">Analphabet</a>  Todos los derechos reservados.</p>	
			</div>
		</footer>		
	</body>
</html>