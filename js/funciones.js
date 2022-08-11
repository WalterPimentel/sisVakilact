function agregardatos(slctCli, vendedor, slctSedes, fechaActual, idpord, cant, rbV1){

	cadena="slctCli=" + slctCli + 
			"&vendedor=" + vendedor +
			"&slctSedes=" + slctSedes +
			"&fechaActual=" + fechaActual +
      "&idpord=" + idpord + 
      "&cant=" + cant +
      "&rbV1=" + rbV1;      

	$.ajax({
		type:"POST",
		url:"../gestion/agregarproductos.php",
		data:cadena,
		success:function(r){
			if(r==1){
				//alertify.success("agregado con exito :)");
			}else{
				//alertify.error("Fallo el servidor :(");

			}
		}
	});

}

function volveragregardatos(idpord, cant, rbV1){

	cadena="idpord=" + idpord + 
      "&cant=" + cant +
      "&rbV1=" + rbV1;      

	$.ajax({
		type:"POST",
		url:"../gestion/volveragregarprod.php",
		data:cadena,
		success:function(r){
			if(r==1){
				//alert("agregado con exito :)");
			}else{
				//alert("Fallo el servidor :(");

			}
		}
	});

}