<?php

  require_once 'Router.php';
  require_once './app/controllers/item_controller.php';

  define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

  $router = new Router();

  $router->addRoute("items", "GET", "ItemController", "index");
  $router->addRoute("item/:id", "GET", "ItemController", "show");
  $router->addRoute("item", "POST", "ItemController", "create");
  $router->addRoute("item/:id", "PUT", "ItemController", "update");

  $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 

?>
