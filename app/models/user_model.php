<?php

    class UserModel {
        private $db;

        public function __construct(){   
          $this->db = new PDO('mysql:host=localhost;port=3307;'.'dbname=db_ecommerce;charset=utf8','root','');
        }
        
        public function getUserByEmail($email)
        {
          $query = $this->db->prepare("SELECT * FROM USER WHERE email = ?");
          $query->execute([$email]);
          return $query->fetch(PDO::FETCH_OBJ);
        }
    }

?>
