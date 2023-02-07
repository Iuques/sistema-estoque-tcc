<?php

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

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;

#rota '/' redireciona para a dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Rotas de autenticação
Route::get('/dashboard', [AuthController::class, 'index']);
#Rota de login, possui '->name('login)' para o laravel entender que esta é a rota de login e poder redirecionar através do middleware
Route::get('/dashboard/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/dashboard/logout', [AuthController::class, 'logout']);
Route::post('/dashboard/login/do', [AuthController::class, 'loginDo']);
Route::post('/dashboard/store', [AuthController::class, 'storeUser']);

// Grupo de rotas que passam pelo middleware, que checa se existe um usuário logado através do auth
Route::group(['middleware' => 'auth'], function() {
    // Rotas relacionadas aos usuários
    Route::get('/users', [UserController::class, 'index']);
    #View com form de cadastro
    Route::get('/users/create', [UserController::class, 'create']);
    #Função de armazenar (o post é usado para receber dados através do request)
    Route::post('/users/store', [UserController::class, 'store']);
    #Função de deletar (o delete é usado)
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy']);
    #View com form de editar
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    #Função de atualizar (o put é usado)
    Route::put('/users/update/{id}', [UserController::class, 'update']);
    #Detalhes do usuário logado
    Route::get('/users/profile/{id}', [UserController::class, 'show']);

    // Rotas relacionadas aos clientes
    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/clients/create', [ClientController::class, 'create']);
    Route::post('/clients/store', [ClientController::class, 'store']);
    Route::delete('/clients/destroy/{id}', [ClientController::class, 'destroy']);
    Route::get('/clients/edit/{id}', [ClientController::class, 'edit']);
    Route::put('/clients/update/{id}', [ClientController::class, 'update']);

    // Rotas relacionadas aos produtos
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy']);
    Route::get('/products/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/products/update/{id}', [ProductController::class, 'update']);

    // Rotas relacionadas aos departamentos
    Route::get('/products/departaments', [DepartamentController::class, 'index']);
    Route::get('/products/departaments/create', [DepartamentController::class, 'create']);
    Route::post('/products/departaments/store', [DepartamentController::class, 'store']);
    Route::delete('/products/departaments/destroy/{id}', [DepartamentController::class, 'destroy']);
    Route::get('/products/departaments/edit/{id}', [DepartamentController::class, 'edit']);
    Route::put('/products/departaments/update/{id}', [DepartamentController::class, 'update']);
    
    // Rotas relacionadas aos fornecedores
    Route::get('/products/suppliers', [SupplierController::class, 'index']);
    Route::get('/products/suppliers/create', [SupplierController::class, 'create']);
    Route::post('/products/suppliers/store', [SupplierController::class, 'store']);
    Route::delete('/products/suppliers/destroy/{id}', [SupplierController::class, 'destroy']);
    Route::get('/products/suppliers/edit/{id}', [SupplierController::class, 'edit']);
    Route::put('/products/suppliers/update/{id}', [SupplierController::class, 'update']);

    // Rotas relacionadas as vendas
    Route::get('/sales', [SaleController::class, 'index']);
    Route::get('/sales/create', [SaleController::class, 'create']);
    Route::post('/sales/store', [SaleController::class, 'store']);
    Route::delete('/sales/destroy/{id}', [SaleController::class, 'destroy']);
    #Retorna uma função que gera um PDF
    Route::get('/sales/receipt/{id}', [SaleController::class, 'generatePDF']);
});

#Rota usada para testes
Route::get('/teste', function () {
    return view('teste');
});
