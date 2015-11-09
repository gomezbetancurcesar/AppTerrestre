<?php
class Xml{
	protected $msg;

	public function generarXmlBody($options = array()){
	  	foreach ($options as &$value){
                if (is_array($value)) {
                        $value = $this->generarXmlBody($value);
                }
        }
        return new SoapVar($options, SOAP_ENC_OBJECT);
	}
}