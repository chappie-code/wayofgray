<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require('track.class.php');


$track = new Track();


//$data = clean_data($_SERVER['QUERY_STRING']);
$data = parse_url($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$output;
parse_str($data['query'],$output);


$visit = $track->set_visit($output);

$_SESSION['visit_id'] = $visit;
