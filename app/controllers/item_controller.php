<?php

  require_once './app/models/category_model.php';
  require_once './app/models/item_model.php';
  require_once './app/views/json_view.php';

  class ItemController 
  {
    private $jsonView;
    private $itemModel;
    private $controllerHelper;
    private $date;

    public function __construct()
    {
      $this->categoryModel = new CategoryModel();
      $this->itemModel = new ItemModel();
      $this->jsonView = new JSONView();
      $this->date = file_get_contents("php://input");
    }

    private function getDate()
    { 
      return json_decode($this->date); 
    } 

    public function index($params = null)
    {
      $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
      $items = $this->itemModel->index($order);
      $this->jsonView->response($items, 200); 
    }

    public function show($params = null)
    {
      if ($this->itemModel->exists($params[":id"]))
      {
        $item = $this->itemModel->show($params[":id"]);
        if($item)
          $this->jsonView->response($item, 200); 
        else
          $this->jsonView->response("Item with id = " . $params[":id"] . " not found ", 404);
      }
      else
        $this->jsonView->response("Item with id = " . $params[":id"] . " not exists ", 400); 
    }
    
    public function create($params = null)
    { 
      $body = $this->getDate();
      if (!empty($body->name) && !empty($body->description) && !empty($body->price) && !empty($body->fk_id_category) && ($this->categoryModel->exists($body->fk_id_category)))
      {
        $id = $this->itemModel->create($body);
        $item = $this->itemModel->show($id);
        $this->jsonView->response($item, 201); 
      }
      else
        $this->jsonView->response("Invalid params", 400); 
    }

    public function update($params = null)
    {
      if ($this->itemModel->exists($params[":id"]))
      {
        $body = $this->getDate();
        if (!empty($body->name) || !empty($body->description) || !empty($body->price) || (!empty($body->fk_id_category) && ($this->categoryModel->exists($body->fk_id_category))))
        {
          $this->itemModel->update($params[":id"],$body);
          $item = $this->itemModel->show($params[":id"]);
          $this->jsonView->response($item, 201); 
        }
        else
          $this->jsonView->response("Unprocessable Entity", 422);
      }
      else
        $this->jsonView->response("Item with id = " . $params[":id"] . " not exists ", 404); 
    }

  }

?>
