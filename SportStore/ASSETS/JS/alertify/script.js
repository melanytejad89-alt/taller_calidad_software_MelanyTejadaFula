function mostrarContenido(numPestaña) {
  // Oculta todo el contenido de las pestañas
  const contenidos = document.querySelectorAll('.contenido');
  contenidos.forEach(contenido => contenido.style.display = 'none');

  // Muestra el contenido de la pestaña seleccionada
  const contenidoMostrar = document.getElementById(`contenido${numPestaña}`);
  contenidoMostrar.style.display = 'block';
}

function muestrausuario(datos){  //recibe el contenido de datos que es una cadena
	//alert(datos);
	d=datos.split('||'); // separa los datos de la cadena con el simbolo || lo convierte en un arreglo
	$('#numeroed').val(d[0]);
	$('#nombreed').val(d[1]);
	$('#contrasenaed').val(d[2]);
	$('#tipousued').val(d[3]);
}

function muestraprove(prove){  //recibe el contenido de datos que es una cadena
	alert(prove);
	pro=prove.split('||'); // separa los datos de la cadena con el simbolo || lo convierte en un arreglo
	$('#identificacioned').val(pro[0]);
	$('#nombresed').val(pro[1]);
	$('#apellidoed').val(pro[2]);
	$('#correoed').val(pro[3]);
	$('#telefonoed').val(pro[4]);
	$('#direccioned').val(pro[5]);
}

