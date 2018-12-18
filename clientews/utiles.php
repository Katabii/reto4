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

function generarXmlMod($idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1)
{
    $fecha = date('d-m-Y');
    $hora = date('H:i:s');
    $firma = hashMD5($fecha, $hora, $password);
    $activeCard = '';

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

// function recuperarEstadoTarjeta($obtenerinfo, $tag)
// {
//     $DOM = new DOMDocument('1.0', 'utf-8');
//     $DOM->loadXML($obtenerinfo);
//     $tarjeta1 = "";
//     $tarjeta2 = "";
//     $numerar = 0;
//     foreach ($DOM->getElementsByTagName($tag) as $tarjet) {
//         if ($numerar == 0) {
//             $tarjeta1 = $tarjet->nodeValue;
//         }
//         if ($numerar == 1) {
//             $tarjeta2 = $tarjet->nodeValue;
//         }
//         $numerar ++;
//     }
//     return array(
//         $tarjeta1,
//         $tarjeta2
//     );
// }

?>