<?php
require_once 'ClassTerrestre.php';

class WebService{
	private $soapWebService;
	private $mensaje;

	public function __construct(){
		$this->soapWebService = new SoapClient("http://localhost:8080/TestWebservice/TestWebservice?WSDL", array(
																												'trace' => 1
		));
	}

	private function generarXmlBody($options = array()){
	  	foreach ($options as $value){
                if (is_array($value)) {
                        $value = $this->generarXmlBody($value);
                }
        }
        return new SoapVar($options, SOAP_ENC_OBJECT);
	}

	public function crearMensaje($datos = array()){
        $return = new ArrayObject();
        $this->mensaje = new stdClass();
        
        foreach ($datos as $datosTerrestre){
            $Terretre = new Terrestre();
            foreach ($datosTerrestre as $campo => $valor){
                $Terretre->{$campo} = $valor;
            }
            $Terretre = new SoapVar($Terretre, SOAP_ENC_OBJECT, null, null, 'transacciones');
            $return->append($Terretre);
        }
        $this->mensaje = new SoapVar($return, SOAP_ENC_OBJECT, null ,null, "aaa");
	}

	public function llamarMetodo($nombre = "TEST"){
        $return = false;
        try{
            $respuesta = $this->soapWebService->$nombre($this->mensaje);
            $return = true;
        } catch (Exception $ex) {
            $return = false;
        }
        return $return;
		//$this->debugger();
	}

	public function debugger(){
		pr(htmlentities($this->soapWebService->__getLastRequest()));
	}
}