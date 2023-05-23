<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/bikes", function () {
    $pdo = new PDO('mysql:host=localhost;dbname=hello-bicycle', 'root');
    $statement = $pdo->prepare('SELECT * FROM bikes');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
});

Route::get("/bike/{id}", function ($id) {
    $pdo = new PDO('mysql:host=localhost;dbname=hello-bicycle', 'root');
    $statement = $pdo->prepare('SELECT * FROM bikes WHERE id = :id');
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
});
