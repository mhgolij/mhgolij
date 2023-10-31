<?php
use \mhgolij\base\http\Controller\Api\Admin\UserGroupApiController;
use \mhgolij\base\http\Controller\Api\Admin\UserApiController;
use \Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'base/admin'],function(){
    Route::resource('user-group', UserGroupApiController::class)->parameters([
        'user-group' => 'userGroup:code',
    ]);
    Route::group(['prefix' => 'user/{userGroup:code}'], function () {
        Route::get('/', [UserApiController::class, 'index'])->name('user.index');
        Route::get('/create', [UserApiController::class, 'create'])->name('user.create');
        Route::post('/store', [UserApiController::class, 'store'])->name('user.store');
        Route::get('/edit/{user:user_name}', [UserApiController::class, 'edit'])->name('user.edit');
        Route::put('/update/{user:user_name}', [UserApiController::class, 'update'])->name('user.update');
    });
});
