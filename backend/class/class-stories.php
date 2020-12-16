<?php

class Stories {
    private $idStory;
    private $idUser;
    private $user;
    private $imageUser;
    private $story;

    public function __construct($idStory,$idUser, $user,$imageUser,$story){
        $this->idStory=$idStory;
        $this->idUser=$idUser;
        $this->user=$user;
        $this->imageUser=$imageUser;
        $this->story=$story;
    }
    
    // fucion para leer la historia del usuario
    public static function getUserStories($idUser){
        $contentFileUser =file_get_contents('../data/users.json');
        $users = json_decode($contentFileUser, true);
        $user= null;
        for ($i=0; $i < sizeof($users); $i++) { 
            if ($users[$i]['idUser']== $idUser){
                $user= $users[$i];
            }
        }
        //historias
        $contentFileStories =file_get_contents('../data/stories.json');
        $stories= json_decode($contentFileStories,true);
        $userStories= array ();
        for ($i=0; $i < sizeof($stories); $i++) { 
            if (in_array($stories[$i]['idUser'],$user['follow'])){
                $userStories[]=$stories[$i];
            }
            
        }
        echo json_encode($userStories);
    }

    /**
     * Get the value of idStory
     */ 
    public function getIdStory()
    {
        return $this->idStory;
    }

    /**
     * Set the value of idStory
     *
     * @return  self
     */ 
    public function setIdStory($idStory)
    {
        $this->idStory = $idStory;

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
     * Get the value of story
     */ 
    public function getStory()
    {
        return $this->story;
    }

    /**
     * Set the value of story
     *
     * @return  self
     */ 
    public function setStory($story)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * Get the value of imageUser
     */ 
    public function getImageUser()
    {
        return $this->imageUser;
    }

    /**
     * Set the value of imageUser
     *
     * @return  self
     */ 
    public function setImageUser($imageUser)
    {
        $this->imageUser = $imageUser;

        return $this;
    }
}


?>