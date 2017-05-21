<?php

require_once("../vendor/autoload.php");
require_once("Medoo.php");
use Medoo\Medoo;
use Infusionsoft\Infusionsoft;
use Infusionsoft\Token;

$connection = [
  'database_type' => 'mysql',
  'database_name' => 'lovesty4_data',
  'server' => 'localhost',
  'username' => 'lovesty4_data',
  'password' => 'pzdIqxizVmW9',
  'charset' => 'utf8'
];


$db = new Medoo($connection);

$o_auth_config = $db->get('oauth','*',['name' => 'infusion-soft']);

print_r($o_auth_config);
/*
Application
    WayofGray
Key:
    acb4a5w894awbuj4r83972br
Secret:
    JWnZKH8Jxg

*/


$infusionsoft = new Infusionsoft(array(
    'clientId'     => $o_auth_config['client_id'],
    'clientSecret' => $o_auth_config['client_secret'],
    'redirectUri'  => 'http://wayofgray.com/code/callback.php',
));





// If we are returning from Infusionsoft we need to exchange the code for an
// access token.
if (isset($_GET['code']) and !$infusionsoft->getToken()) {
	//$db->update('oauth',['access_token' => $infusionsoft->requestAccessToken($_GET['code'])],['name'=>'infusion-soft']);

  $infusionsoft->requestAccessToken($_GET['code']);

}
else {
  $tokenInfo['access_token'] =  $o_auth_config['access_token'];
  $tokenInfo['refresh_token'] = $o_auth_config['refresh_token'];
  $token = new Token(json_decode($tokenInfo, true));
  $infusionsoft->setToken($token) ;
  $token = $infusionsoft->refreshAccessToken();
  $data = [
    'access_token' => $token->accessToken,
    'refresh_token' => $token->refreshToken
  ];

  $db->update('oauth',$data,['name' => 'infusion-soft']);

}



$o_auth_config = $db->get('oauth','*',['name' => 'infusion-soft']);

print_r($o_auth_config);
