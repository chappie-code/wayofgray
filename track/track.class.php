<?php

require_once("Medoo.php");
require_once("routing.class.php");
use Medoo\Medoo;
/**
 *
 */
class Track
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

  function set_visit($data)
  {


    $record_data['session_id'] = session_id();
    $record_data['source'] = $data['utm_source'];
    //$record_data['campaign'] = $data['utm_campaign'];

    //unset($data['utm_source']);
    //unset($data['utm_campaign']);

    $record = $this->get_record_if_exists($record_data,'visit');
    $visit_id = 0;

    if($record > 0)
    {
      $visit_id = $record;
    }
    else {
      $this->db->insert('visit_data',$record_data);

      $visit_id = $this->db->id();
    }


    return $visit_id;
  }

  function set_signup($data)
  {

  }

  function get_record_if_exists($data,$type)
  {

    $row_id= 0;

    if($type == 'visit')
    {
      $row_id = $this->db->max('visit_data','id',$data);
    }

    return $row_id;
  }
}





 ?>
