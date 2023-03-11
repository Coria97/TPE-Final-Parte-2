<?php
  include_once '.\libs\Smarty.class.php';

  class UserView
  {
    private $smarty;

    public function __construct()
    {
      $this->smarty = new Smarty();
    }

    public function login($logged = false, $error = null)
    {
      $this->smarty->assign('logged', $logged);
      $this->smarty->assign('error', $error);
      $this->smarty->display('./templates/login.tpl');
    }

    public function defaultView()
    {
      header("Location: " . BASE_URL. "items");
    }
  }

?>
