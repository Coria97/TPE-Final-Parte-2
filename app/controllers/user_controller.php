<?php

  require_once './app/models/user_model.php';
  require_once './app/views/json_view.php';
  require_once './app/helpers/auth_helper.php';

  function base64url_encode($data) 
  {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
  }

  class UserController 
  {
    private $userModel;
    private $jsonView;
    private $authHelper;
    private $data;

    public function __construct() 
    {
      $this->userModel = new UserModel();
      $this->jsonView = new JSONView();
      $this->authHelper = new AuthHelper();
      $this->data = file_get_contents("php://input");
    }

    private function getData() 
    {
      return json_decode($this->data);
    }

    public function getToken($params = null) 
    {
      // Obtener "Basic base64(user:pass)
      $basic = $this->authHelper->getAuthHeader();
      if(empty($basic))
      {
        $this->jsonView->response('No autorizado', 401);
        return;
      }

      $basic = explode(" ",$basic);  // ["Basic" "base64(user:pass)"]
      if($basic[0]!="Basic")
      {
        $this->jsonView->response('Authentication must be basic', 401);
        return;
      }

      //validar usuario:contraseña
      $userpass = base64_decode($basic[1]); // user:pass
      $userpass = explode(":", $userpass);
      $user = $userpass[0];
      $pass = $userpass[1];
      $user = $this->userModel->getUserByEmail($user);
      $hola = password_verify($pass, $user->password);
      if ($user && password_verify($pass, $user->password)) 
      {
        //  crear un token
        $header = array(
            'alg' => 'HS256',
            'typ' => 'JWT'
        );
        $payload = array(
          'id' => $user->id,
          'name' => $user->email,
          'exp' => time() + 3600
        );
        $header = base64url_encode(json_encode($header));
        $payload = base64url_encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$header.$payload", "Clave1234", true);
        $signature = base64url_encode($signature);
        $token = "$header.$payload.$signature";
        $this->jsonView->response($token, 200);
      }
      else
        $this->jsonView->response('No autorizado', 401);
    }

  }

?>
