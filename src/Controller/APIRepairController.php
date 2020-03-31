<?php

namespace App\Controller;

use App\Entity\Building;
use App\Entity\BuildingType;
use App\Entity\User;
use App\Service\GlobalConfig;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//TODO: pasar como parametro el id del edificio
//TODO: comprobar que el edificio nos pertenece
//TODO: el costo de reparacion no es el mismo para cada edificio
class APIRepairController extends AbstractController
{
    /**
     * @Route("/repair", name="repair")
     */
    public function index(Request $request, GlobalConfig $global_config)
    {
        $mensaje_error = "Not error found";
        $error = false;
        $resultado = '';

        $em = $this->getDoctrine()->getManager();
        //--------------------------------------------------------------------------
        //(1) Obtengo user() de la peticion
        //--------------------------------------------------------------------------
        if ($global_config->isTestMode()) {
            //Fake user si testing mode
            $fake_user = $em->getRepository(User::class)->findOneBy(['name' => $global_config->getTest_user()]);
            $user = $fake_user;

        } else {

            //--------------------------------------------------------------------------------------------------
            // Validando si usuario autenticado correctamente
            //--------------------------------------------------------------------------------------------------

            if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {

                $respuesta = array(
                    'error' => true,
                    'message' => "User not authenticated",
                );

                return $this->json($respuesta, Response::HTTP_OK);

            }
            //usuario real si testing mode = false
            $user = $this->getUser();
        }

        //-------------------------------------------------------------------------------------------------
        //(2) Obteniendo los datos que vienen en la peticion
        //--------------------------------------------------------------------------------------------------
        $parametersAsArray = [];
        $content = $request->get("peticion");

        //variable que contendra el json como un arreglo
        $parametersAsArray = json_decode($content, true);

        //Datos del ataque: arreglo con tropas atacantes, id del edificio a atacar
        $building_id = $parametersAsArray["building_id"];
        $amount_to_pay = $parametersAsArray["payment"];

        
        //1) Buscar el edificio en la BD

        $building = $em->getRepository(Building::class)->findOneBy(['id' => $building_id]);
      
        //2) Buscar el nivel de defensa actual:
        $defenseRemaining = $building->getDefenseRemaining();

        //3) Maximo nivel de defensa
        $building_type_actual = $building->getBuildingType();
        $maxDefense = $building_type_actual->getDefense();

        //3.1) Obtener el precio de reparacion
        $repairCost = $building_type_actual->getRepairCost();
        //1000 point = $repairCost

        $reparacion = round(( 1000 * $amount_to_pay) / $repairCost);

        $defensaFinalDespuesdeReparar =   $defenseRemaining + $reparacion;
                
        //4) si ya esta al maximo de defensa no subir mas
        if ($defensaFinalDespuesdeReparar >= $maxDefense) {
         
            $respuesta = array(
                'error' => true,
                'message' => "Building can't be repaired more",
            );

            return $this->json($respuesta, Response::HTTP_OK);

        };

        //5) Comprobar si existe oro suficiente

        $kingdom = $user->getKingdom();
        $oro_del_kingdom = $kingdom->getGold();
        
         if ($oro_del_kingdom<$amount_to_pay) {
            $this->addFlash('success', 'Not enough gold to repair');

            $respuesta = array(
                'error' => true,
                'message' => "Not enough gold to repair",
            );

            return $this->json($respuesta, Response::HTTP_OK);
        }

        //Continuamos:
        //Disminuir ORO
        $oro_final = $oro_del_kingdom - $amount_to_pay;
        $kingdom->setGold($oro_final);
        $em->persist($kingdom);

        //Modificar building.defense
        
        $building->setDefenseRemaining($defensaFinalDespuesdeReparar);
        $em->persist($building);







        $em->flush();

        

//Objetivo:
        //- cambiar en building.building_type_id -- el tipo de edificio que se corresponde al next level
        //- Descontar el dinero del fondo comun del kingdom kingdom.gold (comprobar que alcanza)
        //- Actualizar la vida del edificio

//var_dump( $building_type_next_level);

      
        

        $respuesta = array(
            'error' => $error,
            'message' => $mensaje_error,
        );

        return $this->json($respuesta, Response::HTTP_OK);

    }
}
