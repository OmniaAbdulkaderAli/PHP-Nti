<?php 
include_once __DIR__ ."/../models/User.php";
class authenticationRequest {
    // validate on mail
    // validate password
    private $email;
    private $password;
    private $confirmPassword;
    private $errors = [];
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
     * Get the value of confirmPassword
     */ 
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of confirmPassword
     *
     * @return  self
     */ 
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    public function emailValidation()
    {
        //validate if empty 
        if(!$this->email){
            $this->errors['email']['email-required'] = "<div class='alert alert-danger'> Email Is Required </div>";
        }else{
            // validate on format of email
            $pattern = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
            if(!preg_match($pattern,$this->email)){
                $this->errors['email']['email-format'] = "<div class='alert alert-danger'> Wrong Email Format </div>";
            }
        }
        return $this->errors;
    }

    public function passwordValidation()
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        // validate if password is empty
        if(!$this->password){
            $this->errors['password']['password-required'] = "<div class='alert alert-danger'> Password Is Required </div>";
        }
        // validate if confrim password is empty
        if(!$this->confirmPassword){
            $this->errors['password']['confirm-password'] = "<div class='alert alert-danger'>Confrim Password Is Required </div>";
        }

        // if no errors
        if(empty($this->errors)){
            // if password confirmed
            if($this->password != $this->confirmPassword){
                $this->errors['password']['not-confirmed'] = "<div class='alert alert-danger'>Password Is N't Confirmed </div>";
            }
            // validate on password format
            if(!preg_match($pattern,$this->password)){
                $this->errors['password']['password-format'] = "<div class='alert alert-danger'> Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character </div>";
            }
        }
        return $this->errors;
    }

    public function urlEmailValidation($url)
    {
        // if GET has value
        if($url){
            // if get has key email 
            if(isset($url['email'])){
                // if get has value of email
                if($url['email']){
                    // check on db 
                    $emailChecked = new User;
                    $emailChecked->setEmail($url['email']);
                    $userData = $emailChecked->emailCheckDB();
                    if($userData){
                        return ($userData->fetch_object());
                    }else{
                        return [];
                    }
                }else{
                    return [];
                }
            }else{
                return [];
            }
        }else{
            return [];
        }
    }

    
    public function passwordValidationLogin()
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        // validate if password is empty
        if(!$this->password){
            $this->errors['password']['password-required'] = "<div class='alert alert-danger'> Password Is Required </div>";
        }
        // if no errors
        if(empty($this->errors)){
            // validate on password format
            if(!preg_match($pattern,$this->password)){
                $this->errors['password']['password-format'] = "<div class='alert alert-danger'> Invalid login try again </div>";
            }
        }
        return $this->errors;
    }


}
