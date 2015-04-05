<?php

header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');

//Conexión a base de datos Mysql

$host = 'localhost';
$username= 'root';
$password = 'mysql';
$db_name = 'municipalidad';

$db=mysql_connect($host, $username, $password) or die('la conexión con la base de datos ah fallado...');

mysql_select_db($db_name, $db) or die('');

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/verificar/:dni', function ($dni) use ($app) {

    $sth = mysql_query("select aldia from autovaluo where dni = '".$dni."'");   
    
	$rows = array();
	while($r = mysql_fetch_assoc($sth)) {
	    $rows[0] = $r;
	}

	echo json_encode($rows);
	exit;

});

$app->get('/', function () {
    echo "MUNICIPALIDAD";
});

$app->run();
