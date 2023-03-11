<?php
   include_once '.\libs\Smarty.class.php';

  class ItemView
  {
    private $smarty;

    public function __construct()
    {
      $this->smarty = new Smarty();
    }

    public function index($logged = false, $items = null, $categories = null)
    { 
      $this->smarty->assign('logged', $logged);
      $this->smarty->assign('categories', $categories);
      $this->smarty->assign('items', $items);
      $this->smarty->display('./templates/items.tpl'); 
    }

    public function show($logged = false, $item = null,  $categories = null)
    {
      $this->smarty->assign('logged', $logged);
      $this->smarty->assign('categories', $categories);
      $this->smarty->assign('item', $item);
      $this->smarty->display('./templates/item.tpl');
    }
  }

?>
