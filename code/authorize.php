<?php

require_once("../vendor/autoload.php");

/*
Application
    WayofGray
Key:
    acb4a5w894awbuj4r83972br
Secret:
    JWnZKH8Jxg

*/


$infusionsoft = new Infusionsoft\Infusionsoft(array(
    'clientId'     => 'acb4a5w894awbuj4r83972br',
    'clientSecret' => 'JWnZKH8Jxg',
    'redirectUri'  => 'http://wayofgray.com/code/callback.php',
));





	echo '<a href="' . $infusionsoft->getAuthorizationUrl() . '">Click here to authorize</a>';
