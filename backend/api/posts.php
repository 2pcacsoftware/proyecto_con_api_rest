<?php
header ("Content-Type: application/json");
include_once ("../class/class-post.php");
//$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //GUARDAR
        $target_dir = "../img/posts/";
        $nameFile = time() ;
        $target_file = $target_dir . $nameFile . basename($_FILES["image"]["name"]);
        $target_file = str_replace(" ","",$target_file);
        $target_file = str_replace("_","",$target_file);
        $target_file = str_replace("-","",$target_file);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file) ;
        $post= new  Post (
            $_POST['idPost'],
            $_POST['idUser'],
            $_POST['contentPost'],
            substr($target_file, 3),
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
        $_PUT = json_decode(file_get_contents('php://input'),true);
        $post = new Post ($_PUT['idPost'],
                            $_PUT['idUser'], 
                            $_PUT['contentPost'], 
                            $_PUT['image'], 
                            $_PUT['amountLikes']);
        $post->updatePost($_GET['idPost']);
        break;
    case 'DELETE': //ELIMINAR
        # code...
        break;
}
?>