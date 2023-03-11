<?php
  
  require_once './app/models/category_model.php';
  require_once './app/models/item_model.php';
  require_once './app/views/item_view.php';
  require_once './app/helpers/controller_helper.php';
  require_once './app/helpers/auth_helper.php';

  class ItemController 
  {
    private $itemView;
    private $itemModel;
    private $categoryModel;
    private $controllerHelper;
    private $authHelper;

    public function __construct()
    {
      $this->itemModel = new ItemModel();
      $this->itemView = new ItemView();
      $this->categoryModel = new CategoryModel();
      $this->controllerHelper = new ControllerHelper();
      $this->authHelper = new AuthHelper();
    }

    public function index()
    { 
      $categories = $this->categoryModel->index();
      $items = $this->itemModel->index();
      $this->itemView->index($this->authHelper->getLogged(), $items, $categories); 
    }

    public function show($id)
    {
      $item = $this->itemModel->show($id);
      $categories = $this->categoryModel->index();
      $this->itemView->show($this->authHelper->getLogged(), $item[0], $categories);
    }

    public function create()
    {
      if ($this->authHelper->isLogged()) 
      {
        if ($this->controllerHelper->validateParams($_POST))
          $this->itemModel->create($_POST);
        $this->index();
      }
    }

    public function delete($id)
    {
      if ($this->authHelper->isLogged()) 
      {
        $this->itemModel->delete($id);
        $this->index();
      }
    }

    public function put($id)
    {
      if ($this->authHelper->isLogged()) 
      {
        if ($this->controllerHelper->validateParams($_POST))
          $item = $this->itemModel->put($id,$_POST);
        $this->index();
      }
    }
    
    public function filter()
    {
      $categories = $this->categoryModel->index();
      $items = $this->itemModel->filter($_GET);
      $this->itemView->index($this->authHelper->getLogged(), $items, $categories);
    }
  }

?>
