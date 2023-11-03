<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
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



Route::get('/', [ProdutoController::class, 'index'])->name('listagem_produtos');


Route::get('/produto/show/{id}', [ProdutoController::class, 'show'])->name('exibir_produto.show');
Route::get('/search', [ProdutoController::class, 'search'])->name('produto.search');
Route::get('/categories/{id}', [ProdutoController::class, 'categories'])->name('produto.categories');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('usuarios', UsuarioController::class);

    Route::resource('produtor', ProdutorController::class);

    Route::get('/meus-produtos', [ProdutoController::class, 'indexAuth'])->name('produto.indexAuth');
    // Route::resource('produto', ProdutoController::class);
    Route::get('/produto/create', [ProdutoController::class, 'create'])->name('produto.create');
    Route::post('/produto/store', [ProdutoController::class, 'store'])->name('produto.store');
    Route::get('/produto/edit/{id}', [ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/produto/update/{id}', [ProdutoController::class, 'update'])->name('produto.update');

    Route::delete('/produto/destroy/{id}', [ProdutoController::class, 'destroy'])->name('produto.destroy');

    Route::resource('pedido', CompraController::class);
});



Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

Route::get('/produtor/create', [ProdutorController::class, 'create'])->name('produtor.create');
Route::post('/produtor', [ProdutorController::class, 'store'])->name('produtor.store');



Route::get('/registration', function () {
    return view('login.registration');
})->name('registration');


require __DIR__.'/auth.php';
