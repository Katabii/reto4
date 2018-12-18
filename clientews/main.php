<?php
header('Content-Type: text/html; charset=ISO-8859-1');
require_once ('lib/nusoap.php');
include ('tarjetasDeCredito.php');
include ('utiles.php');
include ('cripto.php');

// Url del webservice que invocaremos
$wsdl = "http://10.10.3.249:8080/CreditCards/services/CardDispatcher?wsdl";

// Instanciando un nuevo objeto cliente para consumir el webservice
$client = new nusoap_client($wsdl, 'wsdl');

// Variables de cada grupo
$idgrupo = "G4";
$password = "d8NvpzhM";
$isAdmin = true;

// //////////////////////OBTENERCLAVE//////////////////////////

$obtenerClave = obtenerClave($client, $idgrupo, $password);
list ($key, $vector) = $obtenerClave;

// //////////////////OBTENERINFO//////////////////////

$obtenerinfo = obtenerInfo($client, $key, $vector, $idgrupo, $password);

echo "<pre>";
echo $obtenerinfo;
echo "<pre>";

// ///////////////////ACTIVARTARJETA//////////////

if ($isAdmin) {
    
    $tag = 'Numero';
    $recuperarNumTarjetas = recuperarInfoTag($obtenerinfo, $tag);
    list ($tarjeta1, $tarjeta2) = $recuperarNumTarjetas;

    $tag = 'Activa';
    $recuperarEstadoTarjetas = recuperarInfoTag($obtenerinfo, $tag);
    list ($tarjetaEstado1, $tarjetaEstado2) = $recuperarEstadoTarjetas;

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

