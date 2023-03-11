<?php
require_once './app/views/user_view.php';
require_once './app/models/user_model.php';
require_once './app/helpers/auth_helper.php';

class UserController 
{
  private $userView;
  private $userModel;
  private $authHelper;

  public function __construct() {
    $this->userModel = new UserModel();
    $this->userView = new UserView();
    $this->authHelper = new AuthHelper();
  }

  public function login() 
  {   
    $this->userView->login(isset($_SESSION['IS_LOGGED']));
  }

  public function validateUser() 
  {
    var_dump($_POST);
    $user = $this->userModel->getUserByEmail($_POST['email']);
    echo "password_verify: " . password_verify($_POST['password'], $user->password);
    if ($user && password_verify($_POST['password'], $user->password)) 
    {
      session_start();
      $_SESSION['USER_ID'] = $user->id;
      $_SESSION['USER_EMAIL'] = $user->email;
      $_SESSION['IS_LOGGED'] = true;
      header("Location: " . BASE_URL. "items");
    } 
    else 
    {   
      $this->userView->login($this->authHelper->isLogged() , "El usuario o la contraseña no existe."); 
    }
  }

  public function logout() 
  {
    session_start();
    session_destroy();
    header("Location: " . BASE_URL. "items");
  }
}
?>
