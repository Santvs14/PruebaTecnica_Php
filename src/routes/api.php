<?php


// Permitir solicitudes desde cualquier origen o desde localhost:4200 específicamente
header("Access-Control-Allow-Origin: http://localhost:4200"); // Cambia esto si tu frontend tiene un origen diferente

// Permitir los métodos que se usarán en el backend
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Permitir los encabezados que pueden ser utilizados en las solicitudes
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Responder a las solicitudes preflight (OPTIONS) con un código 200
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}






// Habilitar CORS
require_once __DIR__ . '/../config/cors.php';

// Incluir dependencias
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '../Controller/UserController.php';

// Definir rutas
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];



if ($uri === '/user/list' && $method === 'GET') {
    $userController = new UserController($pdo);
    $userController->getAllUsers();
} else {
    http_response_code(404);
    echo json_encode(["message" => "Ruta no encontrada"]);
}
