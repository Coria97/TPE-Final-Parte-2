<?php
  include_once '.\libs\Smarty.class.php';

  class CategoryView
  {
    private $smarty;

    public function __construct()
    {
      $this->smarty = new Smarty();
    }

    public function index($logged = false, $categories)
    {
      $this->smarty->assign('logged', $logged);
      $this->smarty->assign('categories', $categories);
      $this->smarty->display('./templates/categories.tpl'); 
    }

    public function showItems($logged = false, $items = null, $categories = null)
    { 
      $this->smarty->assign('logged', $logged);
      $this->smarty->assign('categories', $categories);
      $this->smarty->assign('items', $items);
      $this->smarty->display('./templates/items.tpl'); 
    }

    public function defaultView($logged = false, $categories)
    {
      $this->smarty->assign('logged', $logged);
      $this->smarty->assign('categories', $categories);
      $this->smarty->display('./templates/categories.tpl'); 
    }
  }
?>
