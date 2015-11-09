<?php

class WebService{
	private $soapWebService;
	private $mensaje;

	public function __construct(){
		$this->soapWebService = new SoapClient("http://localhost:8080/TestWebservice/TestWebservice?WSDL", array(
																												'trace' => 1
		));
	}

	private function generarXmlBody($options = array()){
	  	foreach ($options as &$value){
                if (is_array($value)) {
                        $value = $this->generarXmlBody($value);
                }
        }
        return new SoapVar($options, SOAP_ENC_OBJECT);
	}

	public function crearMensaje($datos = array()){
		//$this->mensaje = $this->generarXmlBody($datos);
		$this->mensaje = $this->generarXmlBody(array('name' => 999));
	}

	public function llamarMetodo($nombre = "TEST"){
		$a = $this->soapWebService->$nombre(new SoapParam($this->mensaje, 'Data'));
		pr($a);
		$this->debugger();
	}

	public function debugger(){
		pr(htmlentities($this->soapWebService->__getLastRequest()));
	}
}