<?php
header ("Content-Type: application/json");
include_once ("../class/class-post.php");
$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //GUARDAR
        $post= new  Post (
            $_POST['idPost'],
            $_POST['idUser'],
            $_POST['contentPost'],
            $_POST['image'],
            $_POST['amountLikes)']
        );
        $post->savePost();
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