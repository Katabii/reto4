<?php

function buscarDentroDeTags($resultados, $tag)
{
    //Se identifican los tags a buscar dentro de la cadena enviada y se extrae la informacion de dentro en una variable
    $regex = '/<' . $tag . '>(.*?)<\/' . $tag . '>/';
    preg_match($regex, $resultados, $matches);
    if (isset($matches[1])) {
        return $matches[1];
    } else {
        echo 'No se ha encontrado ningun tag';
    }
}

function generarXml($idgrupo, $password)
{
    //Se genera el XML y se guarda en una variable como string que se va a enviar como peticion al servidor
    $fecha = date('d-m-Y');
    $hora = date('H:i:s');
    $firma = hashMD5($fecha, $hora, $password);

    $xml = "<?xml version='1.0' encoding='UTF-8'?><MensajePeticion><Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora><idgrupo>" . $idgrupo . "</idgrupo><Firma>" . $firma . "</Firma><Activecard></Activecard></MensajePeticion>";

    return $xml;
}

function generarXmlMod($idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1)
{
    //Se genera el XML y se guarda en una variable como string que se va a enviar como peticion al servidor
    $fecha = date('d-m-Y');
    $hora = date('H:i:s');
    $firma = hashMD5($fecha, $hora, $password);
    $activeCard = '';

    //Comprueba el estado de una de las tarjetas para enviar la peticion de activacion de la otra
    switch ($tarjetaEstado1) {
        case 'No':
            $activeCard = $tarjeta1;
            break;
        case 'Si':
            $activeCard = $tarjeta2;
            break;
    }
    $xml = "<?xml version='1.0' encoding='UTF-8'?><MensajePeticion><Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora><idgrupo>" . $idgrupo . "</idgrupo><Firma>" . $firma . "</Firma><Activecard>" . $activeCard . "</Activecard></MensajePeticion>";

    return $xml;
}

function recuperarInfoTag($obtenerinfo, $tag)
{
    //Se obtienen la informacion de dentro del tag que se especifica de la cadena de texto proporcionada
    $DOM = new DOMDocument('1.0', 'utf-8');
    $DOM->loadXML($obtenerinfo);
    $info1 = "";
    $info2 = "";
    $numerar = 0;
    foreach ($DOM->getElementsByTagName($tag) as $info) {
        if ($numerar == 0) {
            $info1 = $info->nodeValue;
        }
        if ($numerar == 1) {
            $info2 = $info->nodeValue;
        }
        $numerar ++;
    }
    return array(
        $info1,
        $info2
    );
}
?>