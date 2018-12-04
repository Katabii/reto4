<?php 
	include('login.php'); //Incluye el script de login

	if(isset($_SESSION['login_user_sys'])){
		header("location: profile.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Secure credit card management</title>
		<link rel="stylesheet" href="css/estilos.css"/>
		<script src="js/slideshow.js"></script>
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
						<h3>Iniciar sesión</h3>
						<form action="#" method="post">
							<input type="text" placeholder="Nombre de usuario" name="username" required>
							<input type="password" placeholder="Contraseña" name="password" required>
							<input name="submit" type="submit" value="Acceder">
						</form>
						<div class="clear"> </div>
							<span><?php echo $error; ?></span>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="copy-rights">		 	
					<p>© <?php echo date("Y");?> <a href="javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Analphabet</a>  Todos los derechos reservados.</p>
					<div id="light" class="white_content"><p>Analphabet ©, somos un equipo de profesionales en el área de desarrollo de nuevas tecnologías, de muy alta calidad enfocados en resolver sus necesidades de una forma eficiente.<br><br><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Cerrar</a></p></div>
					<div id="fade" class="black_overlay"></div>	
			</div>
		</footer>
	</body>
</html>