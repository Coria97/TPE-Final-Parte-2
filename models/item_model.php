<?php

  require_once './helpers/model_helper.php';
  class ItemModel
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
      $query = $this->db->prepare("SELECT i.*, c.name 'category_name' FROM Item i INNER JOIN Category c ON i.fk_id_category = c.id");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function show($id){
      $query = $this->db->prepare("SELECT i.*, c.name 'category_name' FROM Item i INNER JOIN Category c ON i.fk_id_category = c.id where i.id = ?");
      $query->execute([$id]);
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($params)
    {
      $query = $this->db->prepare("INSERT INTO Item (name, description, price, fk_id_category) VALUES (?,?,?,?)");
      $query->execute([$params['name'],$params['description'],$params['price'],$params['fk_id_category']]);
    }

    public function delete($id)
    {
      $query = $this->db->prepare("DELETE FROM Item WHERE id = ?");
      $query->execute([$id]);   
    }

    public function put($id, $params)
    {
      $this->db->exec($this->modelHelper->buildQuery($id, 'Item', $params));
      return $this->show($id);
    }

    public function filter($params)
    {
      $queryString = $this->buildQueryFilter($params);
      $query = $this->db->prepare($queryString);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_OBJ);
    }

    private function buildQueryFilter($params)
    {
      $query = "SELECT i.*,  c.name 'category_name' FROM Item i INNER JOIN Category c ON i.fk_id_category = c.id WHERE ";
      $queryName = $this->filterName($params['name']);
      $queryPrice = $this->filterPrice($params['min'],$params['max']);
      $queryCategory = $this->filterCategory($params['fk_id_category']);
      if ($queryName != null)
        $query .= $queryName . " AND ";
      if ($queryPrice != null)
        $query .= $queryPrice . " AND ";
      if ($queryCategory != null) 
        $query .= $queryCategory . " AND ";
      if (($queryCategory != null) || ($queryName != null) || ($queryPrice != null))
        $query = rtrim($query, " AND ");
      else
        $query = rtrim($query, " WHERE ");
      return $query;
    }

    private function filterName($name)
    {
      if (!empty($name))
        return "i.name LIKE '%". strval($name). "%' ";
      else return null;  
    }

    private function filterPrice($min, $max)
    { 
      if (empty($min) && empty($max)) 
        return null;
       elseif (empty($min) && $max > 0) 
        return "price <= " . $max;
       elseif (empty($max) && $min >= 0) 
        return "price >= " . $min;
       elseif ($min > $max) 
        return null;
       else 
        return "price >= " . $min . " AND price < " . $max;
    } 
    

    private function filterCategory($category)
    {
      if ($category > 0 )
        return "fk_id_category= ". $category;
      else return null;
    }
  }
?>
