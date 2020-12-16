<?php
header ("Content-Type: application/json");
include_once ("../class/class-stories.php");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //GUARDAR
        # code...
        break;
    case 'GET': //CONSULTAR
        if(isset($_GET['idUser'])){
            Stories::getUserStories($_GET['idUser']);
        }else if(isset($_GET['idStory'])){
            # code...
        }else{
            # code...
        }
        break;
    case 'PUT': //ACTUALIZAR
        # code...
        break;
    case 'DELETE': //ELIMINAR
        # code...
        break;
    }




?>