<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('track.class.php');
require_once('routing.class.php');


$track = new Track();
$rout = new Routing();

//$data = clean_data($_SERVER['QUERY_STRING']);
$data = parse_url($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$output;
parse_str($data['query'],$output);

$lp = $output['lp'];
unset($output['lp']);


$visit = $track->set_visit($output);


$_SESSION['visit_id'] = $visit;
setcookie('visit_id',$visit, time()+60*60*24*30);


$url = $rout->get_url_from_code($lp);

/* This will give an error. Note the output
 * above, which is before the header() call */
header('Location: '.$url);
exit();
die();
