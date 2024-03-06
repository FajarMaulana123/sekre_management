<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('proses_login', [LoginController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->middleware('cek_login');
    Route::get('/user', [AdminController::class, 'user_management'])->middleware('cek_login');
    Route::post('/usermanagemant_', [AdminController::class, 'usermanagement_'])->middleware('cek_login');
    Route::post('/create_usermanagement', [AdminController::class, 'create_usermanagement'])->middleware('cek_login');
    Route::post('/update_usermanagement', [AdminController::class, 'update_usermanagement'])->middleware('cek_login');
    Route::post('/get_modul', [AdminController::class, 'get_modul'])->middleware('cek_login');

    Route::get('/client', [AdminController::class, 'client'])->middleware('cek_login');
    Route::post('/client_', [AdminController::class, 'client_'])->middleware('cek_login');
    Route::post('/create_client', [AdminController::class, 'create_client'])->middleware('cek_login');
    Route::post('/update_client', [AdminController::class, 'update_client'])->middleware('cek_login');
    Route::post('/delete_client', [AdminController::class, 'delete_client'])->middleware('cek_login');

    Route::get('/perusahaan', [AdminController::class, 'perusahaan'])->middleware('cek_login');
    Route::post('/perusahaan_', [AdminController::class, 'perusahaan_'])->middleware('cek_login');
    Route::post('/create_perusahaan', [AdminController::class, 'create_perusahaan'])->middleware('cek_login');
    Route::post('/update_perusahaan', [AdminController::class, 'update_perusahaan'])->middleware('cek_login');
    Route::post('/delete_perusahaan', [AdminController::class, 'delete_perusahaan'])->middleware('cek_login');

    Route::get('/jenis_project', [AdminController::class, 'jenis_project'])->middleware('cek_login');
    Route::post('/jenis_project_', [AdminController::class, 'jenis_project_'])->middleware('cek_login');
    Route::post('/create_jenis_project', [AdminController::class, 'create_jenis_project'])->middleware('cek_login');
    Route::post('/update_jenis_project', [AdminController::class, 'update_jenis_project'])->middleware('cek_login');
    Route::post('/delete_jenis_project', [AdminController::class, 'delete_jenis_project'])->middleware('cek_login');
    Route::post('/update_status_project', [AdminController::class, 'update_status_project'])->middleware('cek_login');

    Route::get('/project', [AdminController::class, 'project'])->middleware('cek_login');
    Route::post('/project_', [AdminController::class, 'project_'])->middleware('cek_login');
    Route::post('/create_project', [AdminController::class, 'create_project'])->middleware('cek_login');
    Route::post('/update_project', [AdminController::class, 'update_project'])->middleware('cek_login');
    Route::post('/delete_project', [AdminController::class, 'delete_project'])->middleware('cek_login');
});
