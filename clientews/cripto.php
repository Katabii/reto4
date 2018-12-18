<?php

////////////AES/////////////////////

function encriptarAes($data, $key, $vector)
{
    $encrypted = openssl_encrypt($data, 'aes-128-cbc', $key, OPENSSL_PKCS1_PADDING, $vector);
    return base64_encode($encrypted);
}

function desencriptarAes($data, $key, $vector)
{
    $data = base64_decode($data);
    return openssl_decrypt($data, 'aes-128-cbc', $key, OPENSSL_PKCS1_PADDING, $vector);
}


//////////////////RSA////////////////

function desencriptarRSA($resultado)
{
    // Preparar la respuesta del servidor (pasar resultado a String)
    $cl = implode(",", $resultado);

    // Quitar los tags de la llave y el vector
    $tag = 'key';
    $tag2 = 'vector';
    $key64 = buscarDentroDeTags($cl, $tag);
    $vector64 = buscarDentroDeTags($cl, $tag2);

    // Decodificar base64
    $keyrsa = base64_decode($key64);
    $vectorrsa = base64_decode($vector64);

    // Extraer la clave publica del certificado y se prepara para usar
    $fname = "public.cert";
    $f = fopen($fname, "r");
    $cert = fread($f, filesize($fname));
    fclose($f);
    $pub_key_res = "";
    $pub_key_res = openssl_pkey_get_public($cert);

    // Desencriptar RSA de la key y el vector
    $key = "";
    $vector = "";
    openssl_public_decrypt($keyrsa, $key, $pub_key_res, OPENSSL_PKCS1_PADDING);
    openssl_public_decrypt($vectorrsa, $vector, $pub_key_res, OPENSSL_PKCS1_PADDING);
    
    return array($key, $vector);
}

////////////////MD5////////////////////

function hashMD5($fecha, $hora, $password){
    $firma = md5("<Fecha>" . $fecha . "</Fecha><Hora>" . $hora . "</Hora>" . $password);
    return $firma;
}

?>