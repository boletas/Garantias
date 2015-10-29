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
                            //Lo que se haceestan  antes de enviar el formulario
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

function ObtieneDatosAnexo(idAnexo){
    $base = $("#base").val();
    $(document).ready(function(){
            $.ajax({
                    dataType:   "json",
                    data    :   {"id_anexo": idAnexo},
                    url     :   ""+$base+"index.php/anexo_controller/ObtieneDatosAnexo",
                    type    :   'post',
                    beforeSend: function(){
                            //Lo que se haceestan  antes de enviar el formulario
                            //$("#razon_social").html("Cargando...");
                    },
                    success: function(respuesta){
                            //lo que se si el destino devuelve algo
                            $("#m_id_anexo").val(respuesta.id_anexo);
                            $("#m_monto_anexo").val(respuesta.monto_anexo);
                            $("#m_fecha_anexo").val(respuesta.fecha_anexo);
                    },
                    error: function(xhr,err){ 
                            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    }
            });
    });
}

function ActualizaAnexo(){
    $base = $("#base").val();
    $id_boleta = $("#idBoleta").val();
    $id_anexo = $("#m_id_anexo").val();
    $monto = $("#m_monto_anexo").val();
    $fecha = $("#m_fecha_anexo").val();
    $(document).ready(function(){
            $.ajax({
                    dataType:   "json",
                    data    :   {   "id_anexo"  : $id_anexo,
                                    "monto"     : $monto,
                                    "fecha"     : $fecha,
                                    "id_boleta" : $id_boleta
                                },
                    url     :   ""+$base+"index.php/anexo_controller/ActualizaAnexo",
                    type    :   'post',
                    beforeSend: function(){
                            //Lo que se haceestan  antes de enviar el formulario
                            //$("#razon_social").html("Cargando...");
                    },
                    success: function(respuesta){
                            //lo que se si el destino devuelve algo
                            var res = respuesta.res;
                            var msj = "";
                            if(res){
                                res = "alert alert-success alert-dismissable";
                                msj = "Se actualizó correctamente el anexo";
                            }else{
                                res = "alert alert-warning alert-dismissable";
                                msj = "Error al tratar de actualizar anexo";
                            }
                            var mensaje = " <div class='"+ res +"' id=\"mensaje\">\n\
                                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>\n\
                                                    "+msj +"\n\
                                            </div>";
                            
                            
                            $('#EditarModal').modal('hide');
                            //if ($('#EditarModal').is(':hidden')){
                            //setTimeout(window.location.reload(true),10000);
                            
                            $('#mensaje_ajax').html(mensaje);
                            //}
                            
                            
                    },
                    error: function(xhr,err){ 
                            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    }
            });
    });
}

