

$(document).ready(function () {


    /*Drop Down Menu Mostrar*/
   $('#navbarDropdown').mouseenter(function () {
        $('.dropdown-menu').slideToggle(300, "linear");
       
    });

           
   

    /*Drop Down Menu Ocultar*/
    $('.dropdown-menu').mouseleave(function () {
        $(this).slideToggle(300, "linear");
          
    });

    $('#boton1').click(function () {
        alert('Hello World BT1qq');
    });

    $('#boton2').click(function () {
        alert('Hello World BT2');
    });

    /*
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

        );*/

})