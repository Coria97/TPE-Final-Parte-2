<?php

  class ControllerHelper
  {
    public function __construct() {}

    public function validateParams($params)
    { 
      foreach (array_keys($params) as $key)
        if (empty($params[$key]))
          return false;
      return true;
    }
  }
?>
