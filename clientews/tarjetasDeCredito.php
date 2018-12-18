<?php

function obtenerClave($client, $idgrupo, $password)
{
    // Variables
    $xml = generarXml($idgrupo, $password);
    // pasando parametros de entrada que seran pasados hacia el metodo
    $param = array(
        'peticion' => $xml
    );

    // llamando al metodo y recuperando el array de productos en una variable
    $resultado = $client->call('obtenerClave', $param);

    // ¿ocurrio error al llamar al web service?
    if ($client->fault) { // si
        $error = $client->getError();
        if ($error) { // Hubo algun error
                      // echo 'Error:' . $error;
                      // echo 'Error2:' . $error->faultactor;
                      // echo 'Error3:' . $error->faultdetail;faultstring
            echo 'Error:  ' . $client->faultstring;
        }

        die();
    }

    $decryptRSA = desencriptarRSA($resultado);
    list ($key, $vector) = $decryptRSA;
    return array(
        $key,
        $vector
    );
}

function obtenerInfo($client, $key, $vector, $idgrupo, $password)
{
    $xml = generarXml($idgrupo, $password);
    // ENCRIPTAR MENSAJE
    $aes = encriptarAes($xml, $key, $vector);

    // pasando parametros de entrada que seran pasados hacia el metodo
    $param = array(
        'request' => $aes,
        'grupo' => $idgrupo
    );

    // llamando al metodo y recuperando el array de productos en una variable
    $resultado = $client->call('obtenerInfo', $param);

    $cl = implode(",", $resultado);
    $aesinfo = desencriptarAes($cl, $key, $vector);
    return $aesinfo;
}

function activarTarjetas($client, $key, $vector, $idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1)
{
    $xml = generarXmlMod($idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1);
    // ENCRIPTAR MENSAJE
    $aes = encriptarAes($xml, $key, $vector);
    
    // pasando parametros de entrada que seran pasados hacia el metodo
    $param = array(
        'request' => $aes,
        'grupo' => $idgrupo
    );
    
    // llamando al metodo y recuperando el array de productos en una variable
    $resultado = $client->call('activarTarjeta', $param);
    
    return $resultado;
}
?>