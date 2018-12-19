<?php

function obtenerClave($client, $idgrupo, $password)
{
    //Generar String que vamos a enviar como peticion
    $xml = generarXml($idgrupo, $password);

    //Pasando parametros de entrada que seran pasados hacia el metodo
    $param = array(
        'peticion' => $xml
    );

    //Se llama al metodo 'obtenerClave' y recupera el array de respuesta en una variable
    $resultado = $client->call('obtenerClave', $param);

    //¿Ocurrio error al llamar al web service?
    if ($client->fault) {
        $error = $client->getError();
        if ($error) {
            echo 'Error:  ' . $client->faultstring;
        }

        die();
    }

    //Desencriptar la respuesta del servidor (RSA)
    $decryptRSA = desencriptarRSA($resultado);
    list ($key, $vector) = $decryptRSA;
    return array(
        $key,
        $vector
    );
}

function obtenerInfo($client, $key, $vector, $idgrupo, $password)
{
    //Generar String que vamos a enviar como peticion
    $xml = generarXml($idgrupo, $password);

    //Encriptar la peticion al servidor (AES)
    $aes = encriptarAes($xml, $key, $vector);

    //Pasando parametros de entrada que seran pasados hacia el metodo
    $param = array(
        'request' => $aes,
        'grupo' => $idgrupo
    );

    //Se llama al metodo 'obtenerInfo' y recupera el array de respuesta en una variable
    $resultado = $client->call('obtenerInfo', $param);

    //Se prepara el array devuelto para ser tratado como string
    $cl = implode(",", $resultado);

    //Desencriptar la respuesta del servidor (AES)
    $aesinfo = desencriptarAes($cl, $key, $vector);
    return $aesinfo;
}

function activarTarjetas($client, $key, $vector, $idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1)
{
    //Generar String que vamos a enviar como peticion
    $xml = generarXmlMod($idgrupo, $password, $tarjeta1, $tarjeta2, $tarjetaEstado1);

    //Encriptar la peticion al servidor (AES)
    $aes = encriptarAes($xml, $key, $vector);
    
    //Pasando parametros de entrada que seran pasados hacia el metodo
    $param = array(
        'request' => $aes,
        'grupo' => $idgrupo
    );
    
    //Se llama al metodo 'activarTarjeta' y recupera el array de respuesta en una variable
    $resultado = $client->call('activarTarjeta', $param);
    
    return $resultado;
}
?>