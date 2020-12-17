<?php

class Post{
    private $idPost;
    private $idUser;
    private $contentPost;
    private $image;
    private $amountLikes;
    
    public function __construct ($idPost,$idUser,$contentPost,$image,$amountLikes){
        $this->idPost=$idPost;
        $this->idUser=$idUser;
        $this->contentPost=$contentPost;
        $this->image=$image;
        $this->amountLikes=$amountLikes;
    }

    public static function getPosts($idUser){
        //user
        $contentFile=file_get_contents('../data/users.json');
        $users = json_decode($contentFile,true);
        $user = null;
        for ($i=0; $i < sizeof($users) ; $i++) { 
            if ($users[$i]["idUser"]==$idUser){
                $user =$users[$i];
                break;
            }
        }
        //comment
        $contentFileComments = file_get_contents('../data/comment.json');
        $comment = json_decode($contentFileComments, true);

        //post
        $contentFilePosts= file_get_contents('../data/posts.json');
        $posts= json_decode($contentFilePosts,true);
        $resultPost =array();
        for ($i=0; $i < sizeof($posts) ; $i++) { 
            if (in_array ($posts[$i]["idUser"], $user["follow"])){
                $posts[$i]["comments"] = array();
                //comments
                for ($j=0;$j<sizeof($comment);$j++){
                    if ($posts[$i]["idPost"]==$comment[$j]['idPost']){
                        $posts[$i]["comments"][]=$comment[$j];
                    }
                }
                // name e image
                for ($j=0;$j<sizeof($users);$j++){
                    if ($posts[$i]["idUser"]==$users[$j]['idUser']){
                        $posts[$i]["name"]=$users[$j]['name'];
                        $posts[$i]["imageAccount"]=$users[$j]['image'];
                    }
                }
                $resultPost[]=$posts[$i];
            }
        }
        
        echo json_encode($resultPost);
    }

    public function savePost(){
        $contentFilePosts = file_get_contents('../data/posts.json');
        $posts =json_decode($contentFilePosts, true);
        $posts[]= array(
            "idPost" => $this->idPost,
            "idUser" => $this->idUser,
            "contentPost" => $this->contentPost,
            "image" => $this->image,
            "amountLikes" => $this->amountLikes
            );
        // atentos a los permisos en linux y en mac por que puede dar fallo de escritura
        $file = fopen('../data/posts.json','w') or ("Error al abrir fichero de salida");
        fwrite($file,json_encode($posts,JSON_UNESCAPED_UNICODE));
        fclose ($file);

        echo '{"codigoResultado":1,"mensaje":"Post guardado con exito"}';
    }


    /**
     * Get the value of idPost
     */ 
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set the value of idPost
     *
     * @return  self
     */ 
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of contentPost
     */ 
    public function getContentPost()
    {
        return $this->contentPost;
    }

    /**
     * Set the value of contentPost
     *
     * @return  self
     */ 
    public function setContentPost($contentPost)
    {
        $this->contentPost = $contentPost;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of amountLikes
     */ 
    public function getAmountLikes()
    {
        return $this->amountLikes;
    }

    /**
     * Set the value of amountLikes
     *
     * @return  self
     */ 
    public function setAmountLikes($amountLikes)
    {
        $this->amountLikes = $amountLikes;

        return $this;
    }
}

?>