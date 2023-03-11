<?php

  class ModelHelper
  {
    public function __construct() {}

    public function buildQuery($id, $table, $params)
    {
      $query = "UPDATE ". $table ." SET ";
      $columns_to_update = array();
      foreach (array_keys($params) as $key) 
        if (!empty($params[$key])) 
          $columns_to_update[] = $key . "='" . $params[$key] . "'";
      $query .= implode(',', $columns_to_update);
      $query .= " WHERE id='".$id."'";
      return $query;
    }
  }
?>
