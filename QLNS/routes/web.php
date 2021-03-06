<?php

use App\Http\Controllers\BangluongController;
use App\Http\Controllers\CanboController;
use App\Http\Controllers\ChucvuController;
use App\Http\Controllers\DmkhoiPbController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Phanquyen\PermissionController;
use App\Http\Controllers\Phanquyen\RolesController;
use App\Http\Controllers\PhongbanController;
use App\Http\Controllers\ThongtinphanmemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[UserController::class,'login'])->name('login');
Route::post('/logined',[UserController::class,'logined'])->name('logined');

Route::middleware('auth')->group(function () {
Route::prefix('danh_muc')->group(function(){
    Route::prefix('/chuc_vu_cb')->group(function(){
        Route::get('/',[ChucvuController::class,'index'])->name('chucvu.index')->middleware('can:list_chucvu');
        Route::post('/store',[ChucvuController::class,'store'])->name('chucvu.store')->middleware('can:add_chucvu');
        Route::get('/delete/{id}',[ChucvuController::class,'destroy'])->name('chucvu.delete')->middleware('can:delete_chucvu');
    });

    Route::prefix('/dm_khoi_pb')->group(function(){
        Route::get('/',[DmkhoiPbController::class,'index'])->name('dmkhoipb.index');
        Route::get('/chitiet/{id}',[DmkhoiPbController::class,'show'])->name('dmkhoipb.detail');
        Route::post('/store',[DmkhoiPbController::class,'store'])->name('dmkhoipb.store');
        Route::get('/delete/{id}',[DmkhoiPbController::class,'destroy'])->name('dmkhoipb.delete');
    });

    Route::prefix('/dm_phongban')->group(function(){
        Route::get('/',[PhongbanController::class,'index'])->name('phongban.index')->middleware('can:list_phongban');
        Route::post('/store',[PhongbanController::class,'store'])->name('phongban.store')->middleware('can:add_phongban');
        Route::get('/chitiet/{id}',[PhongbanController::class,'show'])->name('phongban.detail')->middleware('can:list_phongban');
        Route::get('/delete/{id}',[PhongbanController::class,'destroy'])->name('phongban.delete')->middleware('can:delete_phongban');
    });

    Route::prefix('canbo')->group(function(){
        Route::get('/',[CanboController::class,'index'])->name('canbo.index')->middleware('can:list_canbo');
        Route::get('/dscbngungtheodoi',[CanboController::class,'dscbngungtheodoi'])->name('canbo.dscbngungtheodoi')->middleware('can:list_canbo');
        Route::get('/create',[CanboController::class,'create'])->name('canbo.create')->middleware('can:add_canbo');
        Route::post('/store',[CanboController::class,'store'])->name('canbo.store')->middleware('can:add_canbo');
        Route::get('/edit/{id}',[CanboController::class,'edit'])->name('canbo.edit')->middleware('can:edit_canbo');
        Route::post('/update/{id}',[CanboController::class,'update'])->name('canbo.update')->middleware('can:edit_canbo');
        Route::get('/delete/{id}',[CanboController::class,'destroy'])->name('canbo.delete')->middleware('can:delete_canbo');
        Route::get('/search',[CanboController::class,'search'])->name('canbo.search')->middleware('can:list_canbo');
        Route::get('/result',[CanboController::class,'result'])->name('canbo.result');
        // Route::get('/chitiet',[CanboController::class,'show'])->name('canbo.chitiet');
        Route::get('/inchitiet/{id}',[CanboController::class,'inthongtincanbo'])->name('canbo.inchitiet')->middleware('can:download_canbo');
        Route::post('/indanhsach',[CanboController::class,'indanhsach'])->name('canbo.indanhsach')->middleware('can:download_canbo');
        Route::get('/theodoi',[CanboController::class,'updatetrangthai'])->name('canbo.theodoi')->middleware('can:edit_canbo');
    });
});

Route::prefix('phanquyen')->group(function(){
    Route::prefix('roles')->group(function(){
        Route::get('/',[RolesController::class,'index'])->name('roles.index')->middleware('can:list_roles');
        Route::get('/create',[RolesController::class,'create'])->name('roles.create')->middleware('can:add_roles');
        Route::get('/edit/{id}',[RolesController::class,'edit'])->name('roles.edit')->middleware('can:edit_roles');
        Route::post('/update/{id}',[RolesController::class,'update'])->name('roles.update')->middleware('can:edit_roles');
        Route::post('/store',[RolesController::class,'store'])->name('roles.store')->middleware('can:add_roles');
        Route::get('/delete/{id}',[RolesController::class,'destroy'])->name('roles.delete')->middleware('can:delete_roles');
    });
    Route::prefix('permissions')->group(function(){
        Route::get('/',[PermissionController::class,'index'])->name('permission.index')->middleware('can:list_permission');
        Route::post('/store',[PermissionController::class,'store'])->name('permission.store')->middleware('can:add_permission');
        Route::post('/update/{id}',[PermissionController::class,'update'])->name('permission.update');
        Route::get('/delete/{id}',[PermissionController::class,'destroy'])->name('permission.delete')->middleware('can:delete_permission');
    });
    Route::prefix('taikhoan')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('user.index')->middleware('can:list_taikhoan');
        Route::post('/store',[UserController::class,'store'])->name('user.store')->middleware('can:add_taikhoan');
        Route::post('/update',[UserController::class,'update'])->name('user.update')->middleware('can:edit_taikhoan');
        Route::get('/delete/{id}',[UserController::class,'destroy'])->name('user.delete')->middleware('can:delete_taikhoan');
        Route::get('/doimatkhau',[UserController::class,'viewchangePassword'])->name('viewchangPassword')->middleware('can:edit_taikhoan');
        Route::post('/doimatkhau',[UserController::class,'changePassword'])->name('doimatkhau')->middleware('can:edit_taikhoan');
    });
});

Route::prefix('thuvien')->group(function(){
    Route::prefix('ttpm')->group(function(){
        Route::get('/',[ThongtinphanmemController::class,'index'])->name('ttpm.index')->middleware('can:list_ttpm');
        Route::post('/store',[ThongtinphanmemController::class,'store'])->name('ttpm.store')->middleware('can:add_ttpm');
        Route::get('/delete/{id}',[ThongtinphanmemController::class,'destroy'])->name('ttpm.delete')->middleware('can:delete_ttpm');
        Route::get('/lichsu/{id}',[ThongtinphanmemController::class,'show'])->name('ttpm.lichsu')->middleware('can:lichsu_ttpm');
        Route::post('/update/{id}',[ThongtinphanmemController::class,'update'])->name('ttpm.update')->middleware('can:edit_ttpm');
    });

    Route::prefix('file')->group(function(){
        Route::get('/',[FileController::class,'index'])->name('file.index')->middleware('can:list_file');
        Route::post('/store',[FileController::class,'store'])->name('file.store')->middleware('can:add_file');
        Route::post('/update/{id}',[FileController::class,'update'])->name('file.update')->middleware('can:edit_file');
        Route::get('/delete/{id}',[FileController::class,'destroy'])->name('file.delete')->middleware('can:delete_file');
        Route::get('/lichsu/{id}',[FileController::class,'show'])->name('file.lichsu')->middleware('can:lichsu_file');
    });
});

// Route::prefix('chucnang')->group(function(){
//     Route::prefix('bangluong')->group(function(){
//         Route::get('/',[BangluongController::class,'index'])->name('bangluong.index')->middleware('can:list_bangluong');
//         Route::get('/create',[BangluongController::class,'create'])->name('bangluong.create')->middleware('can:add_bangluong');
//         Route::post('/store',[BangluongController::class,'store'])->name('bangluong.store')->middleware('can:add_bangluong');
//         Route::get('/edit',[BangluongController::class,'edit'])->name('bangluong.edit')->middleware('can:edit_bangluong');
//         Route::post('/update',[BangluongController::class,'update'])->name('bangluong.update')->middleware('can:edit_bangluong');
//         Route::post('/updatect',[BangluongController::class,'updatect'])->name('bangluong.updatect')->middleware('can:edit_bangluong');
//         Route::get('/delete/{id}',[BangluongController::class,'destroy'])->name('bangluong.dellete')->middleware('can:delete_bangluong');
//         Route::get('/chitiet/{id}',[BangluongController::class,'show'])->name('bangluong.show')->middleware('can:list_bangluong');
//         Route::get('/detail/{mabl}/{id}',[BangluongController::class,'detail'])->name('bangluong.chitiet')->middleware('can:list_bangluong');
//         Route::get('/inbangluong/mabl={mabl}',[BangluongController::class,'inbangluong'])->name('bangluong.inbangluong')->middleware('can:list_bangluong');
//     });
// });
Route::get('/tongquan',[UserController::class,'tongquan'])->name('tongquan');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
});