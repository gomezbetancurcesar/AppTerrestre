function validarRut(Rut,Digito){
        var longitud        = Rut.length;
        var factor          = 2;
        var sumaProducto    = 0;
        var con             = 0;
        var caracter     	= 0;

        for( con=longitud-1; con>=0; con--)
        {
                caracter = Rut.charAt(con);
                sumaProducto += (factor * caracter);
                if (++factor > 7)
                        factor=2;		
        }
 
        var digitoAuxiliar	= 11-(sumaProducto % 11);   
        var caracteres		= "-123456789K0";
        var digitoCaracter = caracteres.charAt(digitoAuxiliar);
        return digitoCaracter;
}

$(document).on("ready", function(e){
		var validarSubmit = true;
		var msgError = "<span class=\"mensaje\">Dato incorrecto</span>";

		var validaciones = {
			codigo: {
				'notEmpty': true,
			},
			monto:{
				'notEmpty': true,
				'numeric': true
			},
			fecha:{
				'notEmpty': true
			},
			rut:{
				'notEmpty': true,
				'rut': true
			},
			cantidad:{
				'notEmpty': true,
				'numeric': true
			},
			pais_origen:{
				'notEmpty': true
			},
		};

		$('input[type=text]').focus(function(){
			$(this).removeClass('error');
			$(this).closest('.row').find('.error-container').fadeOut();
		});

		$('.formulario').on("submit", function(e){
			if(validarSubmit){
				var errores = 0;
				$(this).find('input[type=text]').removeClass('error');
				$('.error-container').hide();
				$('.error-container').html('');

				$(this).find('input[type=text]').each(function(){
					var inputName = $(this).prop('name');
					var valor = $(this).val();
					var validar = validaciones[inputName];
					var error = true;

					if(validar.hasOwnProperty('notEmpty')){
						if(valor != ""){
							error = false;	
						}
					}

					if(validar.hasOwnProperty('numeric')){
						if($.isNumeric(valor)){
							error = false;
						}else{
							error = true;
						}
					}

					if(validar.hasOwnProperty('rut')){
						if(valor != ""){
							var rutAux = valor;
	                        var tmp = rutAux.split("-");
	                        
	                        if(tmp.length > 1){
	                                var rut = tmp[0];
	                                var digVer = tmp[1];
	                                digVer = digVer.toUpperCase();

	                                if ( validarRut(rut,digVer) == digVer ){
	                                		//No es un rut valido
	                                        error = false;
	                                }else{
	                                      error = true;  
	                                }
	                        }else{
	                                //No tiene formato de rut.
	                                error = false;
	                        }
						}
					}

					if(error){
						errores++;
						$(this).addClass('error');
						$(this).closest('.row').find('.error-container').hide();
						$(this).closest('.row').find('.error-container').html('');
						$(this).closest('.row').find('.error-container').html(msgError);
						$(this).closest('.row').find('.error-container').fadeIn();
					}
				});

				if(errores > 0){
					return false
				}
			}
		});

		$('.enviar').click(function(e){
			e.preventDefault();
			validarSubmit = false;
			$('.formulario').append("<input type=\"hidden\" name=\"enviar\"  value=\"1\">");
			$('.formulario').submit();
		});
});