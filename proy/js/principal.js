$(document).ready(function(){


	function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
	}

	function obtenerCapacidad(ruta) {
		nombreCookie = "contador"+ruta;
		const capacidadOptima = 270; 
		let capacidadActual  = Number.parseInt(getCookie(nombreCookie),10);
		const porcentajeCapacidad = Math.round((capacidadActual/capacidadOptima)*100);
		let mensaje = "";
		if (porcentajeCapacidad <= 35){
			mensaje = "La mayoria de pasajeros iran sentados"
		}else if (porcentajeCapacidad <= 50)
			mensaje = "La mayoria de pasajeros iran parados"
		else if (porcentajeCapacidad <= 85){
			mensaje = "El bus va moderadamente lleno"
		}else if (porcentajeCapacidad <= 100){
			mensaje = "El bus va muy lleno"
		}else{
			mensaje = "Abstengase de subirse"
		}
		return `La capacidad de la ruta ${ruta} esta al ${porcentajeCapacidad}% \n ${mensaje}`;
	}
	$(document).on("click",".Rutas",function(){
		cliqueado = $(event.target).val();
		nombreCookie = "contador"+cliqueado;
		alert(obtenerCapacidad(cliqueado));
		if (getCookie(nombreCookie)!=""){
			numero = Number.parseInt(getCookie(nombreCookie),10);
			numero++;
			document.cookie=nombreCookie+"="+numero+";path=/";
			console.log(nombreCookie+" tiene "+numero);
		}else{
			document.cookie=nombreCookie+"=1;path=/";
			console.log(nombreCookie+" tiene 0");
		}
		
	});
	function actualizarVisitas(){

		$("td").each(function(){
			if ($(this).attr('tg-contador')){
				nombreColumnaRuta = $(this).attr('tg-contador');
				nombreCookie = "contador"+nombreColumnaRuta;
				if (getCookie(nombreCookie)!=""){
					$(this).text(getCookie(nombreCookie));

				}else{
					$(this).text("0");
				}
			}
		});


	}

	// actualiza las visitas cada segundo
	setInterval(actualizarVisitas,1000);
	
	
	

	// esta funcion es para reiniciar el contador 
	// usando las cookies, buscando la ruta de la cookie
	//despues se borra la cookie
	$(document).on("click","input#miBoton",function(){
		console.log("le hice click ");
		nombreRuta = $(this).attr("tg-ruta");
		numeroVisitas = $(this).closest("td").prev().text();
		nombreCookie="contador"+nombreRuta;
		

		if (getCookie(nombreCookie)!=0 && getCookie(nombreCookie)!=""){

			$.ajax({
				method: 'POST',
				url: 'http://localhost/contador',
				data: {ruta: nombreRuta, visitas: numeroVisitas},
			}).done(function(datos){
				console.log("el resultado de la peticion fue "+datos);
			}).fail(function(){
				console.log("algo malo ha pasado");
			});
			document.cookie=nombreCookie+"=0;path=/";
			actualizarVisitas();	
		}
	});
	// llena lista de seleccion 
	$.ajax({
		method: 'GET',
		url: 'http://localhost/portal/origenes',
	}).done(function(datos){
		parseado = JSON.parse(datos);
		$.each(parseado,function(llave,valor){
			$("#selecOrigenes").append("<option value='"+parseado[llave]['id']+"'>"+parseado[llave]['nombre']+"</option> ");
			$("#seleccionaVerificacion").append("<option value='"+parseado[llave]['id']+"'>"+parseado[llave]['nombre']+"</option> ");
		});

	});
	// verifico si existe un elemento unico del index usuario 
	// para cargar el ajax solo cuando este en el index usuario
	if ($("#paginaUsuario").length){
		var portalSeleccionado = getCookie("id_portal");
		$.ajax({
			method: 'GET',
			url: 'http://localhost/portal/'+portalSeleccionado,
		}).done(function(datos){
			parseado = JSON.parse(datos);
			console.log(parseado["general"]["nombre"]);
			$("title").text(parseado["general"]["nombre"]);
			$("#titulo").text("Rutas "+parseado["general"]["nombre"]);
			console.log(parseado["general"]["img"]);
			$("#paginaUsuario").css("background","url('../../"+parseado["general"]["img"]+"')");
			$("#paginaUsuario").css("background-size","1365px 750px");
			$.each(parseado["rutas"],function(llave,valor){
				var estiloBoton = "" 
				var validacionEstilo = parseado["rutas"][llave]["nombre"].charAt(0).match(/[A-Z]/g);
				if (validacionEstilo){
					estiloBoton = "botonRuta"+validacionEstilo;
				}else{
					estiloBoton = "botonRutaFacil";
				}
				btnRuta = `<input type="button" class="Rutas" value="${parseado["rutas"][llave]["nombre"]}" id="${estiloBoton}">`;	
				$("#contenedor").append(btnRuta);
				
			});
		});

	}

	$("#enviarLista").click(function(){
		var valorSeleccionado = $("#seleccionaVerificacion :selected").val();
		var d = new Date();
		d.setTime(d.getTime() + (1*24*60*60*1000));
		var expiracion = "expires="+d.toUTCString();
		document.cookie = "id_portal="+valorSeleccionado+";"+expiracion+";path=/";
		window.location.href = "../usuario/index.php";
	});

	$("#selecOrigenes").change(function(){

		seleccionado = $("#selecOrigenes option:selected");
		$.each(seleccionado,function(){
			valueseleccionado = $(this).attr("value");
			$.ajax({
				method: 'GET',
				url: 'http://localhost/ruta/'+valueseleccionado+'/portales',
			}).done(function(datos){
				$("#tablaCompleta tbody").html("");
				parseado = JSON.parse(datos);
				$.each(parseado,function(llave,valor){
					fila = `<tr>
	              			<td class="tg-0lax">${valor}</td>
	              			<td class="tg-0lax" tg-contador="${valor}"></td>
	              			<td class="tg-0lax">
	                		<input type="button" class="botonsitos" id="miBoton" tg-ruta="${valor}" value="Reiniciar Contador"
	                  		style="BORDER: rgb(15,15,15) 1px solid; FONT-SIZE: 15pt;color: white; FONT-FAMILY: Verdana; 
	         				BACKGROUND-COLOR: #ad0202"></td>
							</tr>`;

					$("#tablaCompleta tbody").append(fila);
				})

			});
		})

	});




});

