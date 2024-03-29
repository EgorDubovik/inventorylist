<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\SettingsController;
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
       Route::get('/create', [InventoryCategoryController::class, 'create'])->name('category.create');
       Route::post('/create', [InventoryCategoryController::class, 'store']);
       Route::delete('/remove/{category}', [InventoryCategoryController::class,'destroy']);
       Route::get('/edit/{category}', [InventoryCategoryController::class, 'edit'])->name('category.edit');
       Route::post('/edit/{category}', [InventoryCategoryController::class, 'update']);
       Route::post('/signature/save', [InventoryCategoryController::class, 'signature_save']);
       Route::get('/view/{category}', [InventoryCategoryController::class, 'show'])->name('view.category');
       Route::get('/create/pdf/{category}', [InventoryCategoryController::class, 'createPDF'])->name('create.pdf');
       Route::get('/change/status/{category}/{status}',[InventoryCategoryController::class, 'change_status'])->name('change.status');
       // Access
       Route::post('/access/assign/{category}', [InventoryCategoryController::class, 'assign_access'])->name('category.assign.access');
       Route::get('/access/remove/{user}/{category}', [InventoryCategoryController::class, 'access_remove'])->name('access.remove');

   });

   Route::prefix('inventory')->group(function (){
       Route::get('/list/{category}', [InventoryController::class, 'index'])->name('inventory.list');
       Route::post('/create', [InventoryController::class, 'store']);
       Route::delete('/destroy/{inventoryList}', [InventoryController::class, 'destroy']);
       Route::get('/edit/{inventory}' ,[InventoryController::class, 'edit']);
       Route::post('/edit/{inventory}' ,[InventoryController::class, 'update']);
       // Images for inventory
       Route::get('/images/uploads/{inventory}', [InventoryController::class, 'images_upload'])->name('inventory.images.uploads');
       Route::post('/images/store/{inventory}', [InventoryController::class, 'images_store'])->name('inventory.images.store');
       Route::get('{image}/storage/images/{filename}', [InventoryController::class,'view_image'])->name('inventory.image.view');
   });

   Route::prefix('settings')->group(function (){
       Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
       Route::post('/item/add', [SettingsController::class, 'add_item'])->name('settings.add.item');
       Route::get('/item/remove/{item}' , [SettingsController::class, 'remove_item'])->name('settings.remove.item');
   });
});
