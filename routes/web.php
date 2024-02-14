<?php

use App\Http\Controllers\AddUser\AddUser;
use App\Http\Controllers\AddUser\viewAddUser;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Author\addAuthorController;
use App\Http\Controllers\Author\viewAddAuthor;
use App\Http\Controllers\Author\viewAddAuthorController;
use App\Http\Controllers\Books\AddBookController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Materials\AddMaterialController;
use App\Http\Controllers\Materials\ViewMaterialController;
use App\Http\Controllers\Subject\addSubjectController;
use App\Http\Controllers\Subject\viewAddSubject;
use App\Http\Controllers\Subject\viewAddSubjectController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/store', [AuthController::class, 'storeUser'])->name('store');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name("login");
    Route::post('/login/store', [AuthController::class, 'loginStore']);;
    //Route::get('/login/admin', [AuthController::class, 'loginAdmin'])->name("loginAdmin");
    //Route::post('/login/admin/store', [AuthController::class, 'loginAdminStore']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [Controller::class, 'index'])->name("index");
    Route::get('/books', [Controller::class, 'books'])->name("books");
    Route::get('/recentlyAdded', [Controller::class, 'viewRecentlyAdded'])->name("recentryAdded");
    Route::get('/materials/{class}', [ViewMaterialController::class, 'viewMaterial'])->name('materials');
    //Route::post('/logout', [AuthController::class, 'logoutF'])->name('logout');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('login');
    })->name('logout');
    
});

Route::middleware(['isTeacher'])->group(function () {
    Route::get('/add/material', [AddMaterialController::class, 'viewAddMaterial'])->name("material.add");
    Route::post('/material/store', [AddMaterialController::class, 'store'])->name("material.store");
    Route::get('/book/add/', [AddBookController::class, 'viewAddBook'])->name("book.add");
    Route::post('/store/book', [AddBookController::class, 'store'])->name("book.store");
    Route::get('/add/user', [viewAddUser::class, 'view'])->name("user.add");
    Route::post('/store/user', [AddUser::class, 'store'])->name("user.store");
    Route::get('/add/author', [viewAddAuthorController::class, 'view'])->name("author.add");
    Route::post('/store/author', [addAuthorController::class, 'store'])->name("author.store");
    Route::get('/add/subject', [viewAddSubjectController::class, 'view'])->name("subject.add");
    Route::post('/store/subject', [addSubjectController::class, 'store'])->name("subject.store");
});

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/add/material', [AddMaterialController::class, 'viewAddMaterial'])->name("material.add");
    Route::post('/material/store', [AddMaterialController::class, 'store'])->name("material.store");
    Route::get('/book/add/', [AddBookController::class, 'viewAddBook'])->name("book.add");
    Route::post('/store/book', [AddBookController::class, 'store'])->name("book.store");
    Route::get('/add/user', [viewAddUser::class, 'view'])->name("user.add");
    Route::post('/store/user', [AddUser::class, 'store'])->name("user.store");
    Route::get('/add/author', [viewAddAuthorController::class, 'view'])->name("author.add");
    Route::post('/store/author', [addAuthorController::class, 'store'])->name("author.store");
    Route::get('/add/subject', [viewAddSubjectController::class, 'view'])->name("subject.add");
    Route::post('/store/subject', [addSubjectController::class, 'store'])->name("subject.store");
});

// php artisan cache:clear
// php artisan route:clear
// php artisan route:cache
// php artisan cache:clear
// php artisan config:clear