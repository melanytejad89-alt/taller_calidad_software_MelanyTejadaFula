$(document).ready(function(){  //Todo lo que escribamos dentro se va a ejecutar antes que el documento cargue
	$('.ir-arriba').click(function(){ //Estamos accediendo a la clase ir-arriba. Cuando reciba un clic
		$('body, html').animate({
			scrollTop: '0px'
		}, 1000); //tiempo en subir hasta la parte inicial
	});
	$(window).scroll(function(){
		if ($(this).scrollTop() > 0) {
			$('.ir-arriba').slideDown(1000);
		}else {
			$('.ir-arriba').slideUp(1000);
		}	
	});
});
 	