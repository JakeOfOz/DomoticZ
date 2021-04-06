<?php

// Fill in the IP Address or DNS-Hostname of the KM200
define( "km200_gateway_host", '192.168.XXX.XXX' ); 

// Port of KM200, default is 80, do not change if you have not changed it ;)
define( "km200_gateway_port", '80' ); 

/* 
The KM200 encrypts its data, to read it, get your private key at 
https://ssl-account.com/km200.andreashahn.info/ 
With the device password (located on the device sticker, format xxxx-xxxx-xxxx-xxxx), and the password you set yourself in the app
*/ 

//Fill in your private key here
define( "km200_crypt_key_private", hex2bin( 'xxxxx42fdf5a29e3c6ffed343921d4569df5cb2289110073ab096e476e1xxxxx' ) ); 



//Ecrypt function, for when you WRITE data to the KM200
function km200_Encrypt( $encryptData ) 
{ 
    $blocksize = 16;
    $encrypt_padchar = $blocksize - ( strlen( $encryptData ) % $blocksize ); 
    $encryptData .= str_repeat( chr( $encrypt_padchar ), $encrypt_padchar ); 
    
    return base64_encode(
        openssl_encrypt(
            $encryptData,
            "aes-256-ecb",
            km200_crypt_key_private,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING
        )
    );
}

//Decrypt function, to READ data from the KM200
function km200_Decrypt( $decryptData ) 
{ 
    $decrypt = openssl_decrypt( 
        base64_decode( $decryptData ),
        "aes-256-ecb",
        km200_crypt_key_private,
        OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING
    );
//      var_dump($decryptData);

    // remove zero padding 
    $decrypt = rtrim( $decrypt, "\x00" ); 
    // remove PKCS #7 padding 
    $decrypt_len = strlen( $decrypt ); 
    $decrypt_padchar = ord( $decrypt[ $decrypt_len - 1 ] ); 
    for ( $i = 0; $i < $decrypt_padchar ; $i++ ) 
    { 
        if ( $decrypt_padchar != ord( $decrypt[$decrypt_len - $i - 1] ) ) 
        break; 
    } 
    if ( $i != $decrypt_padchar ) 
        return $decrypt; 
    else 
        return substr( 
            $decrypt, 
            0, 
            $decrypt_len - $decrypt_padchar 
        ); 
}


//Get Data function, for actually reading the data
function km200_GetData( $REST_URL ) 
{ 
    $options = array( 
        'http' => array( 
           'method' => "GET", 
           'header' => "Accept: application/json\r\n" .
                        "User-Agent: TeleHeater/2.2.3\r\n" 
        ) 
    ); 
    $context = stream_context_create( $options ); 
    $content = @file_get_contents( 
        'http://' . km200_gateway_host . ':' . km200_gateway_port . $REST_URL, 
        false, 
        $context 
    );

    if ( false === $content ) 
        return false; 
    return json_decode( 
        km200_Decrypt( 
            $content 
        ) 
    ); 
} 


//Set Data function, to write to the KM200
//This is commented out by default, to protect you from writing the wrong stuff to your device
//BE CAREFUL WHEN USING THIS

/*
function km200_SetData( $REST_URL, $Value ) 
{ 
    $content = json_encode( 
        array( 
            "value" => $Value 
        ) 
    ); 
    $options = array( 
        'http' => array( 
           'method' => "PUT", 
            'header' => "Content-type: application/json\r\n" . 
                        "User-Agent: TeleHeater/2.2.3\r\n", 
            'content' => km200_Encrypt( $content ) 
        ) 
    ); 
    $context = stream_context_create( $options ); 
    @file_get_contents( 
        'http://' . km200_gateway_host . ':' . km200_gateway_port . $REST_URL, 
        false, 
        $context 
    ); 
}  
*/

?>
