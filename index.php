<?php
require_once './models/db_connection.php';
require_once './controller/SweetAlert.php';
require_once './controller/Suara.php';
require_once './controller/AuthController.php';


if(!session_id()) session_start();

$db = new Database();

$baseUrl = '/evoting2'; // Set your base URL here


$routes = [
    $baseUrl . '/admin/login' => 'AdminLoginController@index',
    $baseUrl . '/admin/login/post' => 'AdminLoginController@login',
    $baseUrl . '/admin/index' => 'DashboardAdmin@index',
    $baseUrl . '/admin/tambahcalon' => 'TambahCalonController@index',
    $baseUrl . '/admin/datacalon' => 'DataCalonController@index',
    $baseUrl . '/admin/tambahdpt' => 'TambahDPTController@index',
    $baseUrl . '/admin/tambahdpt/store' => 'TambahDPTController@store',
    $baseUrl . '/admin/tambahcalon/store' => 'TambahCalonController@store',
    $baseUrl . '/admin/datadpt' => 'DataDPTController@index',
    $baseUrl . '/admin/datadpt/delete' => 'DataDPTController@deleteData',
    $baseUrl . '/admin/datadpt/edit' => 'DataDPTController@getEditPage',
    $baseUrl . '/admin/datacalon/edit' => 'DataCalonController@getEditPage',
    $baseUrl . '/admin/datadpt/edit/update' => 'DataDPTController@updateDataDPT',
    $baseUrl . '/admin/datacalon/edit/update' => 'DataCalonController@updateDataCalon',
    $baseUrl . '/admin/datacalon/delete' => 'DataCalonController@deleteCalon',
    $baseUrl . '/' => 'UserLoginController@index',
    $baseUrl . '/user/index' => 'UserDashboard@index',
    $baseUrl . '/user/index/vote' => 'UserDashboard@vote',
    $baseUrl . '/user/login' => 'UserLoginController@login',
    $baseUrl . '/user/edit/password' => 'userLoginController@changePassword',
    $baseUrl . '/admin/edit/password' => 'adminLoginController@changePassword',
    $baseUrl . '/admin/logout' => 'AuthController@logout',
    // Add more routes here as needed
];






// Get the requested URL
$requestUri = $_SERVER['REQUEST_URI'];

// Remove any query parameters from the URL
$requestUri = strtok($requestUri, '?');

// Find the corresponding action or controller for the requested route
if (array_key_exists($requestUri, $routes)) {
    $route = $routes[$requestUri];
    $parts = explode('@', $route);
    $controller = $parts[0];
    $method = $parts[1];

    // Include the necessary controller file
    $controllerFilePath = './controller/' . $controller . '.php';
    if (file_exists($controllerFilePath)) {
        require_once $controllerFilePath;

        // Create an instance of the controller and pass the database connection
        if (class_exists($controller)) {
            $controllerInstance = new $controller($db);

            if (method_exists($controllerInstance, $method)) {
                // Call the method
                $controllerInstance->$method();
            } else {
                $errorMessage = 'Method ' . $method . ' does not exist in the controller ' . $controller;
                echo $errorMessage;
            }
        } else {
            $errorMessage = 'Controller class ' . $controller . ' does not exist';
            echo $errorMessage;
        }
    } else {
        // Handle 404 Page Not Found
        $errorMessage = '404 Page Not Found';
        echo $errorMessage;
    }
}
?>
