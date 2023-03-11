<?php

  class AuthHelper
  {
    public function __construct()
    {
      if(session_status() != PHP_SESSION_ACTIVE)
          session_start();
    }

    public function isLogged() 
    {
      if (isset($_SESSION['IS_LOGGED'])) 
        return true;
      header("Location: " . BASE_URL. "login");
    }

    public function getLogged()
    {
      if (isset($_SESSION['IS_LOGGED'])) 
        return true;
      return false;
    }

  }

?>
