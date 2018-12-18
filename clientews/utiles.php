<?php

function buscarDentroDeTags($resultados, $tag)
{
    $regex = '/<' . $tag . '>(.*?)<\/' . $tag . '>/';
    preg_match($regex, $resultados, $matches);
    if (isset($matches[1])) {
        return $matches[1];
    } else {
        echo 'error';
    }
}

function generarXml($idgrupo, $password)
{
    $fecha = date('d-m-Y');
    $hora = date('H:i:s');
    $firma = hashMD5($fecha, $hora, $password);

    $xml = "<?xml version='1.0' encoding='UTF-8'?><MensajePeticion><Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora><idgrupo>" . $idgrupo . "</idgrupo><Firma>" . $firma . "</Firma><Activecard></Activecard></MensajePeticion>";

    return $xml;
}

function generarXmlMod($idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1, $tarjetaEstado2)
{
    $fecha = date('d-m-Y');
    $hora = date('H:i:s');
    $firma = hashMD5($fecha, $hora, $password);

    switch ($tarjetaEstado1) {
        case 'No':
            $xml = "<?xml version='1.0' encoding='UTF-8'?><MensajePeticion><Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora><idgrupo>" . $idgrupo . "</idgrupo><Firma>" . $firma . "</Firma><Activecard>" . $tarjeta1 . "</Activecard></MensajePeticion>";
            break;
        case 'Si':
            $xml = "<?xml version='1.0' encoding='UTF-8'?><MensajePeticion><Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora><idgrupo>" . $idgrupo . "</idgrupo><Firma>" . $firma . "</Firma><Activecard>" . $tarjeta2 . "</Activecard></MensajePeticion>";
            break;
    }
    return $xml;
}

function recuperarNumTarjetas($obtenerinfo, $tag)
{
    $DOM = new DOMDocument('1.0', 'utf-8');
    $DOM->loadXML($obtenerinfo);
    $tarjeta1 = "";
    $tarjeta2 = "";
    $numerar = 0;
    foreach ($DOM->getElementsByTagName($tag) as $tarjet) {
        if ($numerar == 0) {
            $tarjeta1 = $tarjet->nodeValue;
        }
        if ($numerar == 1) {
            $tarjeta2 = $tarjet->nodeValue;
        }
        $numerar ++;
    }
    return array(
        $tarjeta1,
        $tarjeta2
    );
}

function recuperarEstadoTarjeta($obtenerinfo, $tag)
{
    $DOM = new DOMDocument('1.0', 'utf-8');
    $DOM->loadXML($obtenerinfo);
    $tarjeta1 = "";
    $tarjeta2 = "";
    $numerar = 0;
    foreach ($DOM->getElementsByTagName($tag) as $tarjet) {
        if ($numerar == 0) {
            $tarjeta1 = $tarjet->nodeValue;
        }
        if ($numerar == 1) {
            $tarjeta2 = $tarjet->nodeValue;
        }
        $numerar ++;
    }
    return array(
        $tarjeta1,
        $tarjeta2
    );
}

?>