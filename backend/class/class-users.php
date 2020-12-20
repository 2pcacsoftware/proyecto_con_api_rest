<?php
class User {
    private $idUser;
    private $name;
    private $email;
    private $password;
    private $image;
    private $follow;

    public function __construct($idUser,$name,$email,$password,$image,$follow)
    {
        $this->idUser=$idUser;
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
    public static function getUser($idUser){
        $contentFile=file_get_contents('../data/users.json');
        $users= json_decode($contentFile,true);
        for ($i=0; $i < sizeof($users); $i++) { 
            if ($idUser==$users[$i][idUser]){
                $result= $users[$i];
            }
        }
        echo json_encode($result);
    }
    public static function startSession($email,$password){
        $contentFile=file_get_contents('../data/users.json');
        $start= json_decode($contentFile,true);
        $value= array ('startSession'=> 'false', 'idUser'=>'');
        for ($i=0; $i <sizeof($start) ; $i++) { 
            if (($start[$i]['email']==$email) && ($start[$i]['password']==$password)){
                $value['startSession']=true;
                $value['idUser']=$start[$i]['idUser'];
            }
        }
        echo json_encode($value);
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
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

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