<?php
  
  require_once './app/models/item_model.php';
  require_once './app/views/json_view.php';

  class ItemController 
  {
    private $jsonView;
    private $itemModel;

    public function __construct()
    {
      $this->itemModel = new ItemModel();
      $this->jsonView = new JSONView();
    }

    public function index()
    { 
      $items = $this->itemModel->index();
      $this->jsonView->response($items, 200); 
    }
  }

?>
