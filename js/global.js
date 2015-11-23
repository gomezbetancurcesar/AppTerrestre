$(document).on("ready", function(){
		$('#calendario').datepicker({
                    dateFormat: "yy/mm/dd"
                });

		$('.icono-calendario').click(function(){
			$(this).prev('input').focus();
		});

		$('.black-layer, .cancelar, .cerrar a').click(function(e){
			e.preventDefault();
			$('.black-layer').fadeOut();
			$('.detalles').fadeOut();
		});

		$('.ver-detalles').click(function(e){
			e.preventDefault();
			var parent = $(this).closest('tr');
			var codigo = parent.find('.codigo').text();
			var monto = parent.find('.monto').text();
			var fecha = parent.find('.fecha').text();
			var rut = parent.find('.rut').text();
			var cantidad = parent.find('.cantidad').text();
			var paisOrigen =  parent.find('.pais_origen').text();

			$('.show').find('.codigo').html(codigo);
			$('.show').find('.monto').html(monto);
			$('.show').find('.fecha').html(fecha);
			$('.show').find('.rut').html(rut);
			$('.show').find('.cantidad').html(cantidad);
			$('.show').find('.pais_origen').html(paisOrigen);

			$('.black-layer').fadeIn();
			$('.detalles').fadeIn();
		});
});