<?php

use App\App;
use App\Classes\Operacion;
use App\Classes\Exportacion;
use App\Classes\Importacion;

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Content-Type: application/json; charset=UTF-8");

date_default_timezone_set('America/Mexico_City');

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$httpURI = $_SERVER['REQUEST_URI'];
$httpURI = rtrim($httpURI, '/');
$httpURI = filter_var($httpURI, FILTER_SANITIZE_URL);
$httpURI = explode('/', $httpURI);

$httpMethod = $_SERVER['REQUEST_METHOD'];

$fileAPI = !empty($httpURI[1]) ? (string) strtok(strtolower(trim($httpURI[1])), '?') : null;
$id = !empty($httpURI[2]) ? (int) $httpURI[2] : null;

$app = new App($httpMethod, $id);
$response = $app->request($fileAPI);

http_response_code($response['status']);
$responseSerialize = json_encode($response['data'], JSON_UNESCAPED_UNICODE);
echo $responseSerialize;

exit;
