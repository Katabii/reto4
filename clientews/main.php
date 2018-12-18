<?php
// header('Content-Type: text/html; charset=ISO-8859-1');
require_once ('lib/nusoap.php');
include ('tarjetasDeCredito.php');
include ('utiles.php');
include ('cripto.php');

// url del webservice que invocaremos
$wsdl = "http://10.10.3.249:8080/CreditCards/services/CardDispatcher?wsdl";

// instanciando un nuevo objeto cliente para consumir el webservice
$client = new nusoap_client($wsdl, 'wsdl');

$idgrupo = "G4";
$password = "d8NvpzhM";

// //////////////////////OBTENERCLAVE//////////////////////////

$obtenerClave = obtenerClave($client, $idgrupo, $password);
list ($key, $vector) = $obtenerClave;

// //////////////////OBTENERINFO//////////////////////

$obtenerinfo = obtenerInfo($client, $key, $vector, $idgrupo, $password);
echo $obtenerinfo;

// ///////////////////ACTIVARTARJETA//////////////

$tag='idgrupo';
$numTarjeta=recuperarNumTarjetas($obtenerinfo, $tag);

activarTarjetas($client, $key, $vector, $idgrupo, $password);

?>