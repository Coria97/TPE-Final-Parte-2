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

    public function show($id)
    {
      $query = $this->db->prepare("SELECT i.*, c.name 'category_name' FROM Item i INNER JOIN Category c ON i.fk_id_category = c.id where i.id = ?");
      $query->execute([$id]);
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($params)
    {
      $query = $this->db->prepare("INSERT INTO Item (name, description, price, fk_id_category) VALUES (?,?,?,?)");
      $query->execute([$params->name,$params->description,$params->price,$params->fk_id_category]);
      return $this->db->lastInsertId();
    }

    public function update($id, $params)
    {
      $this->db->exec($this->buildQuery($id, $params));
    }

    private function buildQuery($id, $params)
    {
      $query = "UPDATE Item SET ";
      $columns_to_update = array();
      foreach (get_object_vars($params) as $key => $value) {
        if (!empty($value)) {
          $columns_to_update[] = "$key='$value'";
        }
      }
      $query .= implode(',', $columns_to_update);
      $query .= " WHERE id='$id'";
      return $query;
    }

    public function exists($id)
    {
      $query = $this->db->prepare("SELECT * FROM Item WHERE id = ?");
      $query->execute([$id]);
      $item = $query->fetchAll(PDO::FETCH_ASSOC);
      return (!empty($item)) ? true : false;
    }

  }
?>
