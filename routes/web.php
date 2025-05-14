<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryColtroller;
use App\Http\Controllers\ProductController;
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


Route::any('categories-list', [CategoryController::class, 'categoryListData'])->name('Categorylist');
Route::any('add-category', [CategoryController::class, 'addCategory'])->name('Categoryadd');
Route::any('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('Category-edit');
Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('Category-update');
//Route::any('delete-category', [CategoryController::class, 'deleteCategory'])->name('category-delete');

Route::any('/logout', function () {
    return redirect('/login');
})->name('userLogout');


Route::any('add-subcategory', [SubcategoryColtroller::class, 'subcategoryAdd'])->name('subcategory-add');
Route::any('view-subcategory', [SubcategoryColtroller::class, 'subcategoryView'])->name('subcategory-view');
Route::any('/edit-subcategory/{id}', [SubcategoryColtroller::class, 'editSubcategory'])->name('Subcategory-edit');
Route::put('/update-subcategory/{id}', [SubcategoryColtroller::class, 'updateSubcategory'])->name('Subcategory-update');


Route::any('count-product', [ProductController::class, 'productCount'])->name('product-count');
Route::any('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('Product-edit');
Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('Product-update');

Route::any('/products/create', [ProductController::class, 'productCreate'])->name('product-add');
Route::any('/products/category', [ProductController::class, 'updateCategorySelection'])->name('products.category.update');
Route::any('/products/store', [ProductController::class, 'store'])->name('product.store');
Route::any('/products', [ProductController::class, 'productView'])->name('product-view');



Route::get('index-view', [UserAuth::class, 'index'])->name('index-view');



Route::get('/', [UserAuth::class, 'Userindex'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/update/{rowId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::prefix('checkout')->group(function() {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
});