<?php
    include_once './app/controllers/item_controller.php';
    include_once './app/controllers/category_controller.php';
    include_once './app/controllers/user_controller.php';

    //Definicion de la constante que tiene la URL BASE
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    // lee la acción
    if (!empty($_GET['action']))
        $action = $_GET['action'];
    else
        $action = 'home'; // acción por defecto si no envían

    // parsea la accion    
    $params = explode('/', $action);

    $itemController = new ItemController();
    $categoryController = new CategoryController();
    $userController = new UserController();

    // determina que camino seguir según la acción
    switch ($params[0]) {
        case 'items':
            $itemController->index();
            break;
        case 'item':
            $itemController->show($params[1]);
            break;
        case 'create_item':
            $itemController->create();
            break;
        case 'delete_item':
            $itemController->delete($params[1]);
            break;
        case 'put_item':
            $itemController->put($params[1]);
            break;
        case 'filter_item':
            $itemController->filter();
            break;
        case 'categories':
            $categoryController->index();
            break;
        case 'items_x_categories':
            $categoryController->showItems($params[1]);
            break;
        case 'create_category':
            $categoryController->create();
            break;
        case 'delete_category':
            $categoryController->delete($params[1]);
            break;
        case 'put_category':
            $categoryController->put($params[1]);
            break;
        case 'login':
            $userController->login();
            break;
        case 'validate_user':
            $userController->validateUser();
            break;
        case 'logout':
            $userController->logout();
            break;
        case 'items':
            $itemController->index();
            break;
        case 'item':
            $itemController->show($params[1]);
            break;
        case 'create_item':
            $itemController->create();
            break;
        case 'delete_item':
            $itemController->delete($params[1]);
            break;
        case 'put_item':
            $itemController->put($params[1]);
            break;
        case 'filter_item':
            $itemController->filter();
            break;
        case 'categories':
            $categoryController->index();
            break;
        case 'items_x_categories':
            $categoryController->showItems($params[1]);
            break;
        case 'create_category':
            $categoryController->create();
            break;
        case 'delete_category':
            $categoryController->delete($params[1]);
            break;
        case 'put_category':
            $categoryController->put($params[1]);
            break;
        case 'login':
            $userController->login();
            break;
        case 'validate_user':
            $userController->validateUser();
            break;
        case 'logout':
            $userController->logout();
            break;
        default:  //Caso default de la pagina
          echo('500 internal server error'); 
          break;
    }
?>
