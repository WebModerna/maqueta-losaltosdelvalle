$(document).ready(function(){var touch=$('#touch-menu');var menu=$('.menu');$(touch).on('click',function(e){e.preventDefault();menu.slideToggle();});$(window).resize(function(){var w=$(window).width();if(w>767&&menu.is(':hidden')){menu.removeAttr('style');}});});

/* ir arriba */
(function()
{
	$(document).on("ready", ir_arriba);
	
	//primero escondemos la flecha
	function ir_arriba()
	{
		var ocultar =
		{ 
			opacity : 0, 
			visibility : 'hidden'
		};
		
		var mostrar =
		{
			opacity : 0.5, 
			visibility : 'visible'
		};
		
		$( "#ir_arriba" ).css( ocultar );
	
	//la mostramos cuando bajamos y la esconemos cuando subimos
		$(window).scroll(esconder_mostrar);

		function esconder_mostrar ()
		{
			if( $( this ).scrollTop() > 400 )
			{
				$( "#ir_arriba" ).css( mostrar );
			}
			else
			{
				$( "#ir_arriba" ).css( ocultar );
			};
		};
		
		$( "#ir_arriba" ).on( "click", subir );
		function subir()
		{
			$( "body, html, header" ).animate( { scrollTop : 0 }, 800 );
			return false;
		};
	};
}());