<?php

  class ItemModel
  { 
    private $db;

    public function __construct()
    {
      $this->db = new PDO('mysql:host=localhost;port=3307;'.'dbname=db_ecommerce;charset=utf8','root','');
    }
    
    public function index($order)
    {
      $query = $this->db->prepare("SELECT i.*, c.name 'category_name' FROM Item i INNER JOIN Category c ON i.fk_id_category = c.id ORDER BY price $order");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_OBJ);
    }    

  }
?>
