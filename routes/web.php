<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LapBarangKeluarController;
use App\Http\Controllers\LapBarangMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\RegisterController;

use function Ramsey\Uuid\v1;

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

// Route::get('/', function () {
//     return view('Auth.login');
// });


Auth::routes();
Route::resource('barangmasuk', BarangMasukController::class);
Route::resource('barangkeluar', BarangKeluarController::class);
Route::get('/barang', [App\Http\Controllers\BarangController::class, 'getBarang']);
Route::get('/staff', [App\Http\Controllers\StaffController::class, 'getStaff']);
Route::get('/supplier', [App\Http\Controllers\SupplierController::class, 'getSupplier']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/Postregister', [RegisterController::class, 'register'])->name('postregister');

Route::get('/dashboardAdmin', function () {
    return view('dashboard.dashboardAdmin');
})->middleware('auth:admin');

Route::get('/dashboardSupplier', function () {
    return view('dashboard.dashboardSupplier');
})->middleware('auth:web');

Route::get('/dashboardStaff', function () {
    return view('dashboard.dashboardStaff');
})->middleware('auth:staff');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboardAdmin');
})->middleware('auth:admin,web');

Route::get('/lap_barang_keluar/cetakPDF', [LapBarangKeluarController::class, 'cetakPDF'])->name('cetakPDF');
Route::post('/cetakPDF', 'cetakPDF@cetakPDF');

Route::get('/lap_barang_masuk/cetakPDF', [LapBarangMasukController::class, 'cetakPDF'])->name('cetakPDF');
