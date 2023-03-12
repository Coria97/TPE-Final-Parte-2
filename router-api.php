<?php

  require_once 'Router.php';
  require_once './app/controllers/item_controller.php';

   define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

   $router = new Router();

   $router->addRoute("items", "GET", "ItemController", "index");

   $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 

?>
