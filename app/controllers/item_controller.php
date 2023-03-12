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
      $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
      $items = $this->itemModel->index($order);
      $this->jsonView->response($items, 200); 
    }
  }

?>
