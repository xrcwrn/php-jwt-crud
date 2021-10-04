<?php
class Database{
    
    private $db_host = 'localhost';
    private $db_name = 'xrcwrn_sspu';
    private $db_username = '1643co4fdfgrd';
    private $db_password = 'mkJkpprxrFYB1q62';
    
    public function dbConnection(){
        
        try{
            $conn = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
          
    }
}