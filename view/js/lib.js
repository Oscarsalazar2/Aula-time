

	function getVisible()
	{
		// configura la altura del div para evitar el desplazamiento
		$(".tabelarow").css("height",window.innerHeight - 120);
		$(".form").css("height",window.innerHeight - 30);
		
		
	}
		
		
	function abreReserva(o)
	{
		// borrar el CSS de otras tablas
		$(".cuerpo td").css("background-color", ""); 
		// el elemento seleccionado se vuelve verde.
		$(o).css("background-color", "#CAF4D5"); 
	//abre el formulario por AJAX lleno
	$.ajax({
		type: "GET",
		url: "reserva_form.php",
		method: "GET",
		data: "id=" + $(o).attr("id")+"&data=" + data +"&sala_id="+$(o).attr("sala")+"&periodo_id="+$(o).attr("periodo"),
		dataType  : 'html',
		success: function(response) {
					
			$(".cuerpo").css("max-width","calc(100% - 510px)");

			$('.form').show("fast","",function(){ 
							
			$('.form').html(response);
							
			$('#dia').datetimepicker({
				  timepicker:false,
				  format:'d/m/Y'
			});
							
			$('#data_final').datetimepicker({
				  timepicker:false,
				  format:'d/m/Y'
			});
	
			});
		}
	});
	}
	
	function fecharForm()
	{
		$('.form').hide("fast","",function(){     
			$(".cuerpo").css("max-width","calc(100% - 180px)");
		});
	}

	
	var guardando = false;
	
	function gurardarFormularioReserva()
	{

	//obtener todos los datos del formulario
	if(guardando === true)
		return false; 
		
	guardando = true;
	
	$.ajax({
    type: "POST",
    url: 'reserva_form.php',
	method: "POST",
    data: $("#frm_reserva").serialize(),
    success: function(response) {
	  
          // recargando la pagina para dia actual 
		  if($.isNumeric(response))
		  window.location.href = "index.php?data="+ data;
		  else
		  {
		 	alert(response);
			guardando = false;
		  }
		 }
	});
	
	return false;		
			
	}
	
	
	function eliminarFormularioReserva(id)
	{
		
		if(confirm("Eliminar reserva?"))
		{

			$.ajax({
			type: "POST",
			url: 'reserva_eliminar.php',
			method: "POST",
			data: "id=" + id ,
			success: function(response) {
				  // recargar pagina al dia actual
				  if($.isNumeric(response))
				  window.location.href = "index.php?data="+ data;
				  else
					alert(response)
				 }
			});

		}
	}

	function abre(url)
	{
		window.location.href = url;
	}
	