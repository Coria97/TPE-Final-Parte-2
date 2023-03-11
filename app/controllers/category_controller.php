<?php 
  require_once './app/models/category_model.php';
  require_once './app/views/category_view.php';
  require_once './app/helpers/controller_helper.php';
  require_once './app/helpers/auth_helper.php';

  class CategoryController
  {
    private $categoryModel;
    private $categoryView;

    public function __construct()
    {
      $this->categoryModel = new CategoryModel();
      $this->categoryView = new CategoryView();
      $this->controllerHelper = new ControllerHelper();
      $this->authHelper = new authHelper();
    }

    public function index()
    {
      $categories = $this->categoryModel->index();
      $this->categoryView->index($this->authHelper->getLogged(), $categories);
    }

    public function showItems($id)
    {
      $categories = $this->categoryModel->index();
      $items = $this->categoryModel->showItems($id);
      $this->categoryView->showItems($this->authHelper->getLogged(), $items, $categories);
    }

    public function delete($id)
    {
      if ($this->authHelper->isLogged()) 
      {
        $this->categoryModel->delete($id);
        $this->categoryView->defaultView($this->authHelper->getLogged(), $this->categoryModel->index());
      }
    }

    public function create()
    {
      if ($this->authHelper->isLogged()) 
      {
        if ($this->controllerHelper->validateParams($_POST))
          $this->categoryModel->create($_POST);
        $this->categoryView->defaultView($this->authHelper->getLogged(), $this->categoryModel->index());
      }
    }
    
    public function put($id)
    {
      if ($this->authHelper->isLogged()) 
      {
        if ($this->controllerHelper->validateParams($_POST))
          $this->categoryModel->put($id,$_POST);
        $this->categoryView->defaultView($this->authHelper->getLogged(), $this->categoryModel->index());
      }
    }
  }

?>
