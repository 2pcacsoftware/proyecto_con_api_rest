<?php

class Comment {
    private $idComment;
    private $idPost;
    private $user;
    private $comment;

    public function __construct($idComment, $idPost, $user, $comment){
        $this->idComment = $idComment;
        $this->idPost = $idPost;
        $this->user = $user;
        $this->comment = $comment;
    }

    public function saveComment(){
        $contentFileComment = file_get_contents('../data/comment.json');
        $comment =json_decode($contentFileComment, true);
        $comment[]= array(
            "idComment" => $this->idComment,
            "idPost" => $this->idPost,
            "user" => $this->user,
            "comment" => $this->comment
            );
        // atentos a los permisos en linux y en mac por que puede dar fallo de escritura
        $file = fopen('../data/comment.json','w') or ("Error al abrir fichero de salida");
        fwrite($file,json_encode($comment,JSON_UNESCAPED_UNICODE));
        fclose ($file);

        echo '{"codigoResultado":1,"mensaje":"Comment guardado con exito"}';
    }

    /**
     * Get the value of idComment
     */ 
    public function getIdComment()
    {
        return $this->idComment;
    }

    /**
     * Set the value of idComment
     *
     * @return  self
     */ 
    public function setIdComment($idComment)
    {
        $this->idComment = $idComment;

        return $this;
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
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }
}



?>