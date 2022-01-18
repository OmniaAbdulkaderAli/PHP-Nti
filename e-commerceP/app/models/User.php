<?php
include_once "db/database.php";
include_once "db/operaitons.php";
class User extends database implements operations {
    private $id;
    private $name;
    private $phone;
    private $email;
    private $status;
    private $code;
    private $user_type;
    private $gender;
    private $password;
    private $image;
    private $created_at;
    private $updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;
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

        
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        
    }

    /**
     * Get the value of user_type
     */ 
    public function getUser_type()
    {
        return $this->user_type;
    }

    /**
     * Set the value of user_type
     *
     * @return  self
     */ 
    public function setUser_type($user_type)
    {
        $this->user_type = $user_type;

        
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        
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
        $this->password = sha1($password);
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

        
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        
    }


    public function selectData(){
        $query = "SELECT * FROM users";
        return $this->runDQL($query);
    }
    public function insertData(){
        $query = "INSERT INTO `users` (`users`.`name`,`users`.`password`,`users`.`email`,`users`.`phone`,`users`.`gender`,`users`.`code`) 
        VALUES ('$this->name','$this->password','$this->email',$this->phone,'$this->gender',$this->code)";
        // die($query);
        return $this->runDML($query);
    }
    public function deleteData(){

    }
    public function updateData(){
        $query = "UPDATE `users` 
        SET `users`.`name` = '$this->name' ,
            `users`.`phone` = $this->phone ,
            `users`.`gender` = '$this->gender'";
            if($this->image){
                $query .=" ,`users`.`image` = '$this->image' ";
            }
        $query.=    "WHERE `users`.`id` = $this->id";
        return $this->runDML($query);
    }

    public function emailCheckDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email'";
        return $this->runDQL($query);
    }
    public function updateStatus()
    {
       return $this->runDML("UPDATE `users` SET `users`.`status` = $this->status WHERE `users`.`email` = '$this->email' ");
    }

    public function login()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`password` = '$this->password'";
        return $this->runDQL($query);
    }

    public function updateCode()
    {
       return $this->runDML("UPDATE `users` SET `users`.`code` = $this->code WHERE `users`.`email` = '$this->email'");
    }

    public function updatePassword()
    {
        return $this->runDML("UPDATE `users` SET `users`.`password` = '$this->password' WHERE `users`.`email` = '$this->email'");
    }
    public function getUserById()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`id` = '$this->id'";
        return $this->runDQL($query);
    }
}
    