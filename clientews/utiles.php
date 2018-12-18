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

function generarXml($idgrupo, $password, $id)
{
    $fecha = date('d-m-Y');
    $hora = date('H:i:s');
    $firma = hashMD5($fecha, $hora, $password);

    switch ($id) {
        case 0:
            $xml = "<?xml version='1.0' encoding='UTF-8'?><MensajePeticion><Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora><idgrupo>" . $idgrupo . "</idgrupo><Firma>" . $firma . "</Firma><Activecard></Activecard></MensajePeticion>";
            break;
        case 1:
            // echo $obtenerinfo;
            $activeCard1 = '5063514496722532';
            $activeCard2 = '5687580480739820';
            $xml = "<?xml version='1.0' encoding='UTF-8'?><MensajePeticion><Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora><idgrupo>" . $idgrupo . "</idgrupo><Firma>" . $firma . "</Firma><Activecard>" . $activeCard2 . "</Activecard></MensajePeticion>";
            break;
        default:
            break;
    }
    return $xml;
}

function recuperarNumTarjetas($obtenerinfo, $tag)
{
    $regex = '/<' . $tag . '>(.*?)<\/' . $tag . '>/';
    preg_match($regex, $obtenerinfo, $matches);
    echo '<pre>';
    print_r($matches);
    echo '<pre>';
    // $numTarjeta = array(
    // buscarDentroDeTags($obtenerinfo, $tag),
    // buscarDentroDeTags($obtenerinfo, $tag)
    // );
    // var_dump($numTarjeta);
    return $matches[1];
}

?>