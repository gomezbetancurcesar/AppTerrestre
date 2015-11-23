<?php
class WebService{
    private $url = "http://localhost:8080/TestWebservice/TestWebservice?WSDL";
    private $metodo = "insertarCargaMaritima";
    private $tipo = "?";
    
	private $soapWebService;
	private $mensaje;
    
    private $namespaces = array(
        "http://www.duoc.cl/integracion/cargaMaritimaService/types"
    );

	public function __construct(){
		$this->soapWebService = new SoapClient($this->url, array(
                                                            'trace' => 1,
                                                            'typemap' => array(
                                                                array(
                                                                    'type_ns' => 'http://aaaa.aa.cc',
                                                                    'type_name' => 'car',
                                                                    'to_xml' => "algunaFuncion"
                                                                )
                                                            )
                                                            
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
        
        $trx = new SoapVar($this->tipo, XSD_STRING, null, null, "trx", $this->namespaces[0]);
        $return->append($trx);
        foreach ($datos as $datosTerrestre){
            $terrestre = new ArrayObject();
            $codigo = new SoapVar($datosTerrestre['codigo'], XSD_STRING, null, null, 'codigo', $this->namespaces[0]);
            $monto = new SoapVar($datosTerrestre['monto'], XSD_STRING, null, null, 'monto', $this->namespaces[0]);
            $fecha = new SoapVar($datosTerrestre['fecha'], XSD_STRING, null, null, 'fecha', $this->namespaces[0]);
            $rut = new SoapVar($datosTerrestre['rut'], XSD_STRING, null, null, 'rut', $this->namespaces[0]);
            
            $terrestre->append($codigo);
            $terrestre->append($monto);
            $terrestre->append($fecha);
            $terrestre->append($rut);
            $Terretre = new SoapVar($terrestre, SOAP_ENC_OBJECT, null, null, 'transacciones', $this->namespaces[0]);
            $return->append($Terretre);
        }
        $this->mensaje = new SoapVar($return, SOAP_ENC_OBJECT, null, null, null);
	}
    
    public function crearMensajeManual($datos = array()){
        $mensaje = '<ns1:insertarCargaMaritima xmlns:car="http://www.duoc.cl/integracion/cargaMaritimaService" xmlns:typ="http://www.duoc.cl/integracion/cargaMaritimaService/types">';
        //$mensaje = '<car:insertarCargaMaritimaRequestDocument xmlns:car="http://www.duoc.cl/integracion/cargaMaritimaService" xmlns:typ="http://www.duoc.cl/integracion/cargaMaritimaService/types">';
            $mensaje .= "<typ:trx>".$this->tipo."</typ:trx>";
            foreach ($datos as $terrestres){
                $mensaje .= "<typ:transacciones>";
                    $mensaje .= "<typ:codigo>".$terrestres['codigo']."</typ:codigo>";
                    $mensaje .= "<typ:monto>".$terrestres['monto']."</typ:monto>";
                    $mensaje .= "<typ:fecha>".$terrestres['fecha']."</typ:fecha>";
                    $mensaje .= "<typ:rut>".$terrestres['rut']."</typ:rut>";
                $mensaje .= "</typ:transacciones>";
            }
        //$mensaje .= "</car:insertarCargaMaritimaRequestDocument>";
        $mensaje .= "</ns1:insertarCargaMaritima>";
        $this->mensaje = new SoapVar($mensaje, XSD_ANYXML);
    }

	public function llamarMetodo(){
        $return = false;
        try{
            $respuesta = $this->soapWebService->{$this->metodo}($this->mensaje);
            $return = true;
        } catch (Exception $ex){
            pr("Ha ocurrido el siguiente error:");
            pr($ex->getMessage());
            die();
            $return = false;
        }
        return $return;
		//$this->debugger();
	}

	public function debugger(){
		pr($this->soapWebService->__getLastRequest());
        die();
	}
}