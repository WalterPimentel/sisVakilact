$(document).ready(function(){
    $('#slctSedes').on('change',function(){                                      
      let valor = $('#slctSedes').val();
      console.log(valor);
      $.ajax({                        
         type: 'POST',                 
         url : '../gestion/ventas.php',                   
         data: {value: valor},
         success: function(data)            
         {
  
         }
       });
    });
  });

  function muestraselect(str){ //funcion para crear la conexion asincronica
    var conexion;

    if(str==""){
        document.getElementById("txtHint").innerHTML=""; // si la variable a enviar viene vacia retornamos a nada la funcion
        return;
    }
    if (window.XMLHttpRequest){
        conexion = new XMLHttpRequest();  // creamos una nueva instacion del obejeto XMLHttpRequest
    }

    // verificamos el onreadystatechange verifando que el estado sea de 4 y el estatus 200
    conexion.onreadystatechange=function(){  
        if(conexion.readyState==4 && conexion.status==200){
            //especificamos que en el elemento HTML cuyo id esa el de "div" vacie todos los datos de la respuesta 
            document.getElementById("div").innerHTML=conexion.responseText; 
        }
    }
    //abrimos una conexion asincronica usando el metodo GET y le enviamos la variable c
    conexion.open("GET", "../gestion/ventas.php?c="+str, true);
    //po ultimo enviamos la conexion
    conexion.send();

}