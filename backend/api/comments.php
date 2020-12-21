<?php
header ("Content-Type: application/json");
include_once ("../class/class-comment.php");
$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //GUARDAR
        $comment= new  Comment (
            $_POST['idComment'],
            $_POST['idPost'],
            $_POST['user'],
            $_POST['comment']
        );
        $comment->saveComment();
        break;
    case 'GET': //CONSULTAR
        # code...
        break;
    case 'PUT': //ACTUALIZAR
        # code...
        break;
    case 'DELETE': //ELIMINAR
        # code...
        break;
}
?>