<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryColtroller;
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
    return view('auth.login');
});

//user onboarding routes
Route::post('user', [UserAuth::class, 'userLogin']);
Route::get('login', [UserAuth::class, 'login'])->name('login');
Route::get('register', [UserAuth::class, 'register'])->name('register');

Route::post('register-now', [UserAuth::class, 'registerUser'])->name('userRegister');
Route::post('login-user', [UserAuth::class, 'loginUser'])->name('userLogin');
Route::any('logout-user', [UserAuth::class, 'logoutUser'])->name('userLogout');

//Middleware route
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserAuth::class, 'home'])->name('dashboard_home');
});

//Route::any('categories-add', [CategoryController::class, 'categoriesAdd'])->name('Categorydd');
Route::any('categories-list', [CategoryController::class, 'categoryListData'])->name('Categorylist');
Route::any('add-category', [CategoryController::class, 'addCategory'])->name('Categoryadd');
Route::any('edit-category', [CategoryController::class, 'editCategory'])->name('Category-edit');
Route::any('delete-category', [CategoryController::class, 'deleteCategory'])->name('category-delete');

Route::any('/logout', function () {
    return redirect('/login');
})->name('userLogout');


Route::any('add-subcategory', [SubcategoryColtroller::class, 'subcategoryAdd'])->name('subcategory-add');
Route::any('view-subcategory', [SubcategoryColtroller::class, 'subcategoryView'])->name('subcategory-view');

