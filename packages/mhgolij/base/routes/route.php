<?php

use \Illuminate\Support\Facades\Route;
use \mhgolij\base\http\Controller\Admin\Dashboard;
use \mhgolij\base\http\Controller\Admin\UserGroup\UserController;
use \mhgolij\base\http\Controller\Admin\UserGroup\UserGroupController;
use \mhgolij\base\http\Controller\Admin\RolesController;
//\Illuminate\Support\Facades\Auth::loginUsingId(1);
Route::group(['prefix' => 'admin','as'=>'base.admin.', 'middleware' => ['auth','is_admin']], function () {
    Route::get('dashboard', [Dashboard::class, 'dashboard'])->name('base.admin.dashboard');
    Route::resource('user-group', UserGroupController::class)->parameters([
        'user-group' => 'userGroup:code',
    ])->middleware(['can:userGroupsManage']);
    Route::group(['prefix' => 'user/{userGroup:code}','middleware'=>['can:usersManage']], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{user:user_name}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{user:user_name}', [UserController::class, 'update'])->name('user.update');
    });
    Route::resource('roles', RolesController::class)->parameters([
        'roles'=>'role:name'
    ])->middleware(['can:rolesManage']);
});
