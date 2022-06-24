<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
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

Route::prefix("auth")->group(function(){
    Route::get("/register",[RegisterController::class,'create']);
    Route::post("/register", [RegisterController::class,"store"]);
    Route::get("/login", [LoginController::class,'view'])->name('login');
    Route::post("/login", [LoginController::class,'login']);
    Route::get('/logout', [LoginController::class,'destroy']);
});

Route::group(['middleware' => ['auth']],function (){
   Route::get('/',function(){
       return view('dashboard');
   });

   Route::prefix('profile')->group(function (){
      Route::get('/',[ProfileController::class, 'index'])->name('profile');
      Route::post('/edit',[ProfileController::class, 'update']);
      Route::post('/change/password', [ProfileController::class,'change_password']);
   });

   Route::prefix('users')->group(function (){
       Route::get('/', [UserController::class, 'list'])->name('users');
       Route::get('/create', [UserController::class, 'create']);
       Route::post('/create', [UserController::class, 'store']);
   });

   Route::prefix('inventory')->group(function (){
       Route::get('/category', [InventoryController::class, 'view_categorys']);
       Route::get('/category/create', [InventoryController::class, 'create_inventory_category']);
       Route::post('/category/create', [InventoryController::class, 'store_inventory_category']);
       Route::get('/list/{category}', [InventoryController::class, 'list']);

   });
});
