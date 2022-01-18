<?php
class database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $name = 'nti_ecommerce';
    private $con;

    function __construct()
    {
        $this->con = new mysqli($this->host,$this->username,$this->password,$this->name);
        if($this->con->connect_error){
            die("Connection Faild ".$this->con->connect_error);
        }
    }

    // insert-update-delete
    public function runDML($query)
    {
       $result = $this->con->query($query);
       if($result){
            return TRUE;
       }else{
            return FALSE;
       }
    }

    // selects
    public function runDQL($query)
    {
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            return $result;
        }else{
            return [];
        }
    }
}
