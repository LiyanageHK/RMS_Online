<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\InventoryController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Auth::routes();





Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // 🔸 Category CRUD
    Route::get('categories', [ItemCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [ItemCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories/store', [ItemCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/edit/{id}', [ItemCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update/{id}', [ItemCategoryController::class, 'update'])->name('admin.categories.update');
    Route::get('categories/delete/{id}', [ItemCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // 🔸 Item CRUD
    Route::get('items', [ItemController::class, 'index'])->name('admin.items.index');
    Route::get('items/create', [ItemController::class, 'create'])->name('admin.items.create');
    Route::post('items/store', [ItemController::class, 'store'])->name('admin.items.store');
    Route::get('items/edit/{id}', [ItemController::class, 'edit'])->name('admin.items.edit');
    Route::post('items/update/{id}', [ItemController::class, 'update'])->name('admin.items.update');
    Route::get('items/delete/{id}', [ItemController::class, 'destroy'])->name('admin.items.destroy');

    // Production CRUD
    Route::get('production', [ProductionController::class, 'index'])->name('admin.production.index');
    Route::get('production/create', [ProductionController::class, 'create'])->name('admin.production.create');
    Route::post('production/store', [ProductionController::class, 'store'])->name('admin.production.store');
    Route::get('production/edit/{id}', [ProductionController::class, 'edit'])->name('admin.production.edit');
    Route::post('production/update/{id}', [ProductionController::class, 'update'])->name('admin.production.update');
    Route::get('production/delete/{id}', [ProductionController::class, 'destroy'])->name('admin.production.destroy');
    Route::delete('production/image/delete/{id}', [ProductionController::class, 'deleteImage'])->name('admin.production.image.delete');

    // Role CRUD
    Route::get('role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('admin.role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::get('role/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

    // Product Categories CRUD
    Route::prefix('productcategories')->group(function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('admin.productcategories.index');
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('admin.productcategories.create');
        Route::post('/store', [ProductCategoryController::class, 'store'])->name('admin.productcategories.store');
        Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])->name('admin.productcategories.edit');
        Route::post('/update/{id}', [ProductCategoryController::class, 'update'])->name('admin.productcategories.update');
        Route::get('/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.productcategories.destroy');
    });
    Route::resource('employees', EmployeeController::class);
    Route::get('profile', [EmployeeController::class, 'profile'])->name('employees.profile');
    Route::put('profile', [EmployeeController::class, 'updateProfile'])->name('employees.updateProfile');
    Route::get('change-password', [EmployeeController::class, 'showChangePasswordForm'])->name('employees.changePasswordForm');
    Route::post('change-password', [EmployeeController::class, 'changePassword'])->name('employees.changePassword');

    Route::get('/user_permissions', [AuthController::class, 'getUserPermissions']);
    Route::post('/update_permission', [AuthController::class, 'updatePermission'])->name('admin.update.permission');

    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('admin.inventory.index');
        Route::get('/{id}', [InventoryController::class, 'show'])->name('admin.inventory.show');
        Route::get('/low-stock', [InventoryController::class, 'lowStock'])->name('admin.inventory.low-stock');
    });
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Employee Routes

// Inventory Routes

   