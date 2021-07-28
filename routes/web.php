<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//rota pagina inicial
Route::get('/', [PhotoController::class,'index']);

//rota minhas fotos
Route::get('/photos', [PhotoController::class,'showAll']);

//rota que exibe o formulario de cadastro
Route::get('/photos/new', [PhotoController::class,'create']);

//rota que exibe o formulario de edicao
Route::get('/photos/edit/{id}', [PhotoController::class,'edit']);

//rota que insere no banco de dados uma nova foto
Route::post('/photos', [PhotoController::class,'store']);

//rota que altera uma foto no banco de dados
Route::put('/photos/{id}', [PhotoController::class,'update']);


