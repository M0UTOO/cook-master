<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    $hostname = '<STACKHERO_MARIADB_HOST>';
    $user = 'root';
    $password = '<STACKHERO_MARIADB_ROOT_PASSWORD>';
    $database = 'root'; // You shouldn't use the "root" database. This is just for the example. The recommended way is to create a dedicated database (and user) in PhpMyAdmin and use it then here.

    $mysqli = mysqli_init();
    $mysqliConnected = $mysqli->real_connect($hostname, $user, $password, $database, NULL, NULL, MYSQLI_CLIENT_SSL);
    if (!$mysqliConnected) {
        die("Connect Error: " . $mysqli->connect_error());
    }

    echo 'Success... ' . $mysqli->host_info . "\n";

    $mysqli->close();
});
