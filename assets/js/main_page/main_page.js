console.log("sss");

$(document).ready(function() {
    $('#boton1').click(function() {
        alert('H ola mundo1');
    });


    $('#boton1').click(
        function () {
  
            $.get("datos/datos.txt",
                function (datos_recibidos, estado, xhr ) {
                    console.log("mensaje "+datos_recibidos);
                    console.log("estado "+estado);
                    console.log("xhr "+xhr);

                }

            );
        }

    );

})