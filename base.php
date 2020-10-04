<?php
    Class Database{
        private $host="localhost";
        private $dbname="student";
        private $username=" root@localhost";
        private $password="";
        
        public $conn;
        
        public function getconnection(){
            $this->conn=null;
            
            try{
             $this->conn= new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username,$this->password); 
             $this->conn->exec("set names utf8");
            } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        }
    }
?>