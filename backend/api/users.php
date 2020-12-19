<?php
header ("Content-Type: application/json");
include_once ("../class/class-users.php");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //GUARDAR
        # code...
        break;
    case 'GET': //CONSULTAR
        if (isset($_GET['email'] )&& isset($_GET['password'])){
            $result= User::startSession($_GET['email'],$_GET['password']);
        }else{
            if(isset($_GET['id'])){
                User::getUser($_GET['id']);
            }else{
                User::getUsers();
            }
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