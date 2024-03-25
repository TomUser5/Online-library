<?php

use App\Http\Controllers\AddUser\AddUser;
use App\Http\Controllers\AddUser\viewAddUser;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Author\addAuthorController;
use App\Http\Controllers\Author\viewAddAuthor;
use App\Http\Controllers\Author\viewAddAuthorController;
use App\Http\Controllers\Books\AddBookController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Materials\AddMaterialController;
use App\Http\Controllers\Materials\deleteMaterialController;
use App\Http\Controllers\Materials\ViewMaterialController;
use App\Http\Controllers\Subject\addSubjectController;
use App\Http\Controllers\Subject\viewAddSubject;
use App\Http\Controllers\Subject\viewAddSubjectController;
use App\Http\Controllers\TypeFile\addTypeFile;
use App\Http\Controllers\TypeFile\viewTypeFile;
use App\Http\Controllers\Users\deleteUserController;
use App\Http\Controllers\Users\viewUserController;
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
    Route::get('/', [AuthController::class, 'login'])->name("login");
    Route::post('/login/store', [AuthController::class, 'loginStore']);
    Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password/change', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [Controller::class, 'index'])->name("index");
    Route::get('/books', [Controller::class, 'books'])->name("books");
    Route::get('/recentlyAdded', [Controller::class, 'viewRecentlyAdded'])->name("recentryAdded");
    Route::get('/materials/{class}', [ViewMaterialController::class, 'viewMaterial'])->name('materials');
    //Route::post('/logout', [AuthController::class, 'logoutF'])->name('logout');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
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
    Route::get('/view/import/users', [viewAddUser::class, 'viewImportUser'])->name("view.user.import");
    Route::post('/import/users', [AddUser::class, 'importUsers'])->name("user.import");
    Route::get('/add/type', [viewTypeFile::class, 'view'])->name("type.add");
    Route::post('/store/type', [addTypeFile::class, 'store'])->name("type.store");
    Route::get('/users/{class}', [viewUserController::class, 'viewUsers'])->name('users');
    Route::delete('/users/delete/{id}', [deleteUserController::class, 'deleteUser'])->name('user.delete');
    Route::delete('/material/delete/{id}', [deleteMaterialController::class, 'deleteMaterial'])->name('material.delete');
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
    Route::get('/view/import/users', [viewAddUser::class, 'viewImportUser'])->name("view.user.import");
    Route::post('/import/users', [AddUser::class, 'importUsers'])->name("user.import");
    Route::get('/add/type', [viewTypeFile::class, 'view'])->name("type.add");
    Route::post('/store/type', [addTypeFile::class, 'store'])->name("type.store");
    Route::get('/users/{class}', [viewUserController::class, 'viewUsers'])->name('users');
    Route::delete('/users/delete/{id}', [deleteUserController::class, 'deleteUser'])->name('user.delete');
    Route::delete('/material/delete/{id}', [deleteMaterialController::class, 'deleteMaterial'])->name('material.delete');
});

// php artisan cache:clear
// php artisan route:clear
// php artisan route:cache
// php artisan cache:clear
// php artisan config:clear