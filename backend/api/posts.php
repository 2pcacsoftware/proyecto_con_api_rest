<?php
header ("Content-Type: application/json");
include_once ("../class/class-post.php");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //GUARDAR
        # code...
        break;
    case 'GET': //CONSULTAR
        if(isset($_GET['idUser'])){
            Post::getPosts($_GET['idUser']);
        }else if(isset($_GET['idPost'])){
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