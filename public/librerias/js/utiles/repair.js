
function boton_repair(ruta){
//TODO: agregar codigo para reparar cualquier edificio



    
    $("#repair_main_castle").click(
        function (event) {
            event.preventDefault();
          

           // var total_a_donar = $("#money").val();
           var building_id = $("#repair_main_castle").attr('building_id');
           var payment = $("#repair_main_castle_value").val();
         
            var peticion_all = {};
    
            peticion_all.building_id= building_id;
            peticion_all.payment = payment;
    
            var datos_enviar = {
                peticion: JSON.stringify(peticion_all)
                // peticion: peticion_all
            }
    
           // console.log(datos_enviar);
    
            $.post(ruta,
                datos_enviar
    
                ,
                function (data, textStatus, jqXHR) {
    
    
                }
            ).done(
                function (data) {
                    //console.log("done");
                    console.log(data);
                    location.reload();
                }
    
            ).fail(
                function (data, textStatus, jqXHR) {
                    console.log(textStatus + ' : ' + jqXHR);
                }
    
            ).always(
                function () {
                    //console.log("always");
                }
    
            );
    
            //escribir mensaje de confirmacion al usuario
            // console.log("sss"+ruta_move_troops);
    
    
    
        }
    );
    
    
    }