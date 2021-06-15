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

//rota que exibe o formulario de cadastro
Route::get('/photos/new', [PhotoController::class,'create']);

//rota que insere no banco de dados uma nova foto
Route::post('/photos', [PhotoController::class,'store']);


