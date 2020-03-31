


    


//-------------------------------------------------------------------------
// Datos del kingdom y del user
//-------------------------------------------------------------------------
function dibujarDatosUsuarioHTML(team, recursos) {

    var fondos_kingdom =team.kingdom_gold;

    if (fondos_kingdom==null) {
        fondos_kingdom=0;
    }
     
   //console.log(team);

    $('#kingdom_name').html(team.kingdom_name);
    $('#user_name').html(recursos.user_name);
    $('#user_gold').html(recursos.gold);    
    $('#user_points').html(recursos.user_points);

    $('#kingdom_points').html(team.kingdom_points);
 
    $('#kingdom_gold').html(fondos_kingdom);
}

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