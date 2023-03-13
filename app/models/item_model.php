<?php

  class ItemModel
  { 
    private $db;

    public function __construct()
    {
      $this->db = new PDO('mysql:host=localhost;port=3307;'.'dbname=db_ecommerce;charset=utf8','root','');
    }
    
    public function index($params)
    {
      $query = $this->db->prepare($this->buildQueryIndex($params));
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
      $this->db->exec($this->buildQueryUpdate($id, $params));
    }

    public function delete($id)
    {
      $query = $this->db->prepare("DELETE FROM Item WHERE id = ?");
      $query->execute([$id]); 
    }

    public function exists($id)
    {
      $query = $this->db->prepare("SELECT * FROM Item WHERE id = ?");
      $query->execute([$id]);
      $item = $query->fetchAll(PDO::FETCH_ASSOC);
      return (!empty($item)) ? true : false;
    }

    private function buildQueryUpdate($id, $params)
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

    private function buildQueryIndex($params)
    { 
      $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
      $query = "SELECT i.*, c.name 'category_name' FROM Item i INNER JOIN Category c ON i.fk_id_category = c.id ORDER BY price $order";
      if (isset($_GET['page']) && isset($_GET['limit']))
      { 
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $offset = (($page - 1) * $limit);
        $query .= " LIMIT $limit OFFSET $offset";
      }
      return $query;
    }

  }
  
?>
