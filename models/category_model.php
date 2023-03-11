<?php

  require_once './helpers/model_helper.php';
  class CategoryModel
  { 
    private $db;
    private $modelHelper;

    public function __construct()
    {
      $this->db = new PDO('mysql:host=localhost;port=3307;'.'dbname=db_ecommerce;charset=utf8','root','');
      $this->modelHelper = new ModelHelper();
    }
    
    public function index()
    {
      $query = $this->db->prepare("SELECT * FROM Category c");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function showItems($id)
    {
      $query = $this->db->prepare("SELECT i.*, c.name 'category_name' FROM Item i INNER JOIN Category c ON c.id = i.fk_id_category WHERE i.fk_id_category = ?");
      $query->execute([$id]);
      return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($id)
    {
      $query = $this->db->prepare("DELETE FROM Category WHERE id = ?");
      $query->execute([$id]);
    }

    public function create($params)
    {
      $query = $this->db->prepare("INSERT INTO Category (name, description) VALUES (?,?)");
      $query->execute([$params['name'],$params['description']]);
    }

    public function put($id, $params)
    {
      $this->db->exec($this->modelHelper->buildQuery($id, 'Category', $params));
      return $this->index();
    }
  }
?>
