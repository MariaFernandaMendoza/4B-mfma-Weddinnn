<?php



    require_once ("controladores/plantilla.controlador.php");
    require_once ("controladores/formularios.controlador.php");
    require_once ("modelos/formularios.modelos.php");

    $plantilla = new ControladorPLantilla();
    $plantilla -> ctrTraerPlantilla();

    