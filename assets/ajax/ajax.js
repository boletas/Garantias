function CambiaRazon(){
    $base = $("#base").val();
    $rut = $("#rut").val();
    $(document).ready(function(){
        $("#rut").change(function(){
           $.ajax({
                    dataType:   "json",
                    data    :   {"idEntidad": $rut},
                    url     :   ""+$base+"index.php/boleta_controller/EntidadxId",
                    type    :   'post',
                    beforeSend: function(){
                            //Lo que se hace antes de enviar el formulario
                            //$("#razon_social").html("Cargando...");
                            },
                    success: function(respuesta){
                            //lo que se si el destino devuelve algo
                            $("#razon_social").html(respuesta.html);
                    },
                    error:	function(xhr,err){ 
                            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    }
            });
           
        });
    });
}

function ObtieneRetiro(){
    $base = $("#base").val();
    $rut = $("#rut").val();
    $(document).ready(function(){
            $.ajax({
                    dataType:   "json",
                    data    :   {"rut": $rut},
                    url     :   ""+$base+"index.php/pendientes_controller/PersonaRetiro",
                    type    :   'post',
                    beforeSend: function(){
                            //Lo que se hace antes de enviar el formulario
                            //$("#razon_social").html("Cargando...");
                    },
                    success: function(respuesta){
                            //lo que se si el destino devuelve algo
                            $("#nombre").val(respuesta.nombre);
                            $("#apellido").val(respuesta.apellido);
                    },
                    error: function(xhr,err){ 
                            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    }
            });
    });
}