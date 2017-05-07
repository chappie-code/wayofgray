<?php

require_once("Medoo.php");
use Medoo\Medoo;
/**
 *
 */
class Routing
{
  public $db;

  function __construct()
  {
    $connection = [
      'database_type' => 'mysql',
    	'database_name' => 'lovesty4_data',
    	'server' => 'localhost',
    	'username' => 'lovesty4_data',
    	'password' => 'pzdIqxizVmW9',
    	'charset' => 'utf8'
    ];


    $this->db = new Medoo($connection);
  }


  function get_url_from_code($code)
  {
      $url = $this->db->get('landing_pages','url',['code' =>$code]);

      return $url;
  }
}





 ?>
