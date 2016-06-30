<?php

require_once('/webservice/lib/nusoap.php');
$ns="http://www.remisesapipe/webservice/";
// Se crea el objeto para el webservice
$servicio = new soap_server();
$servicio->configureWSDL("saludo", $ns);
$servicio->wsdl->schemaTargetNamespace=$ns;
$servicio->register("saludo",array("nombre" =>"xsd:string"),array("return" => "xsd:string"),$ns);

// La funcion que se va a exportar
function saludo($nombre)
{
        $saludito= "Hola ".$nombre;
		return new soapvar ('return','xsd:string',$saludito);
}

// Se inicializa el webservice

// Se registra la funcion que se va a exportar, con el tipo de datos de entrada y el tipo de dato de salida

// Como el servicio es proveedo por un servidor WEB la informacion delwebservice sera recibida en METHOD POST
$servicio->service($HTTP_RAW_POST_DATA);
?>
