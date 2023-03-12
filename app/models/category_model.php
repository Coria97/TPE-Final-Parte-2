<?php

  class CategoryModel
  { 
    private $db;

    public function __construct()
    {
      $this->db = new PDO('mysql:host=localhost;port=3307;'.'dbname=db_ecommerce;charset=utf8','root','');
    }
    
    public function exists($id)
    {
      $query = $this->db->prepare("SELECT * FROM Category WHERE id = ?");
      $query->execute([$id]);
      $category = $query->fetchAll(PDO::FETCH_ASSOC);
      return (!empty($category)) ? true : false;
    }
    

  }

?>
