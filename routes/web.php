<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Liste Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});
Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth')->name('dashboard.categories.index');
Route::post('/dashboard/subcategories', [CategoryController::class, 'storeSubcategory'])->name('subcategories.store');

Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');

Route::get('dashboard/chatgroups/{chatGroup}/edit', [GroupController::class, 'edit']);

Route::resource('/dashboard/chatgroups', GroupController::class)->middleware('auth');
Route::middleware('admin')->group(function() {

});
