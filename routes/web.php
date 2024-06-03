<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

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

Route::get('/', [UserController::class, 'homePage']);
Route::post('/', [UserController::class, 'homePage']);

Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/view-blog/{id}', [BlogController::class, 'viewBlog']);
Route::post('/share-blog/{id}', [BlogController::class, 'shareBlog']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [UserController::class, 'getDashboard']);
    Route::get('/add-blog', [BlogController::class, 'addBlog']);
    Route::post('/add-blog', [BlogController::class, 'addBlogPost']);
    Route::get('/edit-blog/{id}', [BlogController::class, 'getEditBlog']);
    Route::post('/edit-blog/{id}', [BlogController::class, 'editBlog']);
    Route::get('/delete-blog/{id}', [BlogController::class, 'deleteBlog']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/blog-list', [AuthController::class, 'blogList']);
});