<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryCategoryController;
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

Route::group(['middleware' => ['auth','active']],function (){
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
       Route::get('/update/{user}', [UserController::class, 'edit']);
       Route::post('/update/{user}', [UserController::class, 'update']);
       Route::delete('/deactivate/{user}', [UserController::class,'destroy']);
   });

   Route::prefix('/category')->group(function (){
       Route::get('/', [InventoryCategoryController::class, 'index'])->name('categories');
       Route::get('/create', [InventoryCategoryController::class, 'create']);
       Route::post('/create', [InventoryCategoryController::class, 'store']);
       Route::delete('/remove/{category}', [InventoryCategoryController::class,'destroy']);
       Route::get('/edit/{category}', [InventoryCategoryController::class, 'edit']);
       Route::post('/edit/{category}', [InventoryCategoryController::class, 'update']);
       Route::post('/signature/save', [InventoryCategoryController::class, 'signature_save']);
       Route::get('/view/{category}', [InventoryController::class, 'viewPDF'])->name('view.category');
   });

   Route::prefix('inventory')->group(function (){
       Route::get('/list/{category}', [InventoryController::class, 'index'])->name('inventory.list');
       Route::post('/create', [InventoryController::class, 'store']);
       Route::delete('/destroy/{inventoryList}', [InventoryController::class, 'destroy']);
       Route::get('/edit/{inventory}' ,[InventoryController::class, 'edit']);
       Route::post('/edit/{inventory}' ,[InventoryController::class, 'update']);
   });
});
