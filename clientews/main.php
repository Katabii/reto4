<?php
header('Content-Type: text/html; charset=ISO-8859-1');
require_once ('lib/nusoap.php');
include ('tarjetasDeCredito.php');
include ('utiles.php');
include ('cripto.php');

//Url del webservice que invocaremos
$wsdl = "http://10.10.3.249:8080/CreditCards/services/CardDispatcher?wsdl";

//Instanciando un nuevo objeto cliente para consumir el webservice
$client = new nusoap_client($wsdl, 'wsdl');

// /////////////////////VARIABLES//////////////////////////
$idgrupo = "G4"; //Cambiar ID cada Grupo
$password = "d8NvpzhM"; //Cambiar Contraseña cada Grupo
$isAdmin = true;

// //////////////////////OBTENERCLAVE//////////////////////////
$obtenerClave = obtenerClave($client, $idgrupo, $password);
list ($key, $vector) = $obtenerClave;

// //////////////////OBTENERINFO//////////////////////
$obtenerinfo = obtenerInfo($client, $key, $vector, $idgrupo, $password);

// /////////////////RECUPERAR INFO DE TAGS//////////////////
$tag = 'Caducidad';
$recuperarCadTarjetas = recuperarInfoTag($obtenerinfo, $tag);
list ($caducidad1, $caducidad2) = $recuperarCadTarjetas;

$tag = 'Numero';
$recuperarNumTarjetas = recuperarInfoTag($obtenerinfo, $tag);
list ($tarjeta1, $tarjeta2) = $recuperarNumTarjetas;

$tag = 'Activa';
$recuperarEstadoTarjetas = recuperarInfoTag($obtenerinfo, $tag);
list ($tarjetaEstado1, $tarjetaEstado2) = $recuperarEstadoTarjetas;

// ///////////////////MOSTRAR INFORMACION/////////////////
echo '<pre>';
echo '<b>Tarjeta 1: </b><br>   Activa: '.$tarjetaEstado1.'<br>   Caducidad: '.$caducidad1.'<br>   Num. Tarjeta: '.$tarjeta1.'<br>';
echo '<br><b>Tarjeta 2: </b><br>   Activa: '.$tarjetaEstado2.'<br>   Caducidad: '.$caducidad2.'<br>   Num. Tarjeta: '.$tarjeta2;
echo '<pre>';

// ///////////////////ACTIVARTARJETA//////////////
if ($isAdmin) {
    
    // BOTON//
    if (isset($_POST["boton"])) {

        activarTarjetas($client, $key, $vector, $idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1);
        header(("location:main.php"));
    }
    ?>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
	<input type="Submit" name="boton" value="Cambiar">
</form>
<?php
}
?>

