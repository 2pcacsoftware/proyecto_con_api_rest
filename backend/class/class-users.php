<?php
class User {
    private $idUser;
    private $name;
    private $email;
    private $password;
    private $image;
    private $follow;

    public function __construct($IdUser,$name,$email,$password,$image,$follow)
    {
        $this->IdUser=$IdUser;
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
        $this->image=$image;
        $this->follow=$follow;
    }
    //metodo para obtener usuario
    public static function getUsers(){
        $contentFile=file_get_contents('../data/users.json');
        echo $contentFile;
    }
    public static function getUser($id){

    }

    /**
     * Get the value of IdUser
     */ 
    public function getIdUser()
    {
        return $this->IdUser;
    }

    /**
     * Set the value of IdUser
     *
     * @return  self
     */ 
    public function setIdUser($IdUser)
    {
        $this->IdUser = $IdUser;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Get the value of follow
     */ 
    public function getFollow()
    {
        return $this->follow;
    }

    /**
     * Set the value of follow
     *
     * @return  self
     */ 
    public function setFollow($follow)
    {
        $this->follow = $follow;

        return $this;
    }
}




?>