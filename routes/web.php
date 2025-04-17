<?php

use App\Models\PerformaHarian;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DasboardAdminController;
use App\Http\Controllers\PerformaHarianController;
use App\Http\Controllers\ClientInformationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PerformanceBulananController;
use App\Http\Controllers\ClientLayananController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\MarketingController;

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

// Untuk user dengan role_id 1
Route::get('/', function () {
    return redirect('/sign-in');
});

// Rute untuk login
Route::get('/sign-in', [LoginController::class, 'create'])->name('login');
Route::post('/sign-in', [LoginController::class, 'store']);

// Rute untuk clients (hanya untuk role 1, 2, 4, dan 5)
Route::middleware(['auth', 'checkUserRole:1,2,4,5'])->group(function () {
    Route::resource('/clients', ClientController::class);
    // Route::resource('/marketing', MarketingController::class);
    Route::post('/client-layanan', [ClientLayananController::class, 'store'])->name('client_layanan.store');
    Route::resource('/laporan-bulanan', PerformanceBulananController::class);
    Route::resource('/laporan-harian', PerformaHarianController::class);
    Route::post('/laporan-harian/store-lead', [PerformaHarianController::class, 'store_lead'])->name('laporan-harian.store-lead');
    Route::put('/laporan-harian/update-lead/{id}', [PerformaHarianController::class, 'updateLead'])->name('laporan-harian.update_lead');
    Route::get('/divisi-sa', [SaController::class, 'index'])->name('divisi-sa.index');
    Route::resource('/acount', UserController::class);
});
Route::middleware(['auth', 'checkUserRole:1,2'])->group(function () {
    Route::get('/dashboard', [DasboardAdminController::class, 'index'])->name('dashboard');
    Route::post('/acount/reset-password/{id}', [UserController::class, 'resetPassword'])->name('acount.reset-password.reset');
    Route::delete('/laporan-harian/{id}', [PerformaHarianController::class, 'destroy_lead'])->name('laporan-harian.destroy_lead');
});

Route::middleware(['auth', 'checkUserRole:3'])->group(function () {
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
    Route::get('/marketing/layanan/{id}/edit', [MarketingController::class, 'edit'])->name('marketing.edit');
    Route::get('/get-available-layanan/{clientId}', [MarketingController::class, 'getAvailableLayanan']);
});


Route::middleware(['auth', 'checkUserRole:6', 'encryptDecrypt'])->group(function () {
    Log::info('User with role_id 6 accessed the route.');
    Route::get('/data-client', [ClientInformationController::class, 'index'])->name('data-client.index');
    Route::get('/data-client/{client_id}/{layanan}/laporan-bulanan', [ClientInformationController::class, 'bulanan'])
        ->name('data-client.laporan-bulanan');
    Route::get('/data-client/laporan-bulan', [ClientInformationController::class, 'prosesLayananA'])->name('data-client.laporan-bulan');
    Route::get('/data-client/laporan-harian', [ClientInformationController::class, 'harian'])->name('data-client.laporan-harian');
    Route::post('/data-client/laporan-harian/store-lead', [ClientInformationController::class, 'store_lead'])->name('data-client.laporan-harian.store-lead');
    Route::put('/data-client/laporan-harian/update-lead/{id}', [ClientInformationController::class, 'updateLead'])->name('data-client.laporan-harian.update-lead');
});

// Rute untuk unauthorized
Route::get('/unauthorized', function () {
    return view('unauthorized'); // Pastikan Anda memiliki view 'unauthorized.blade.php'
})->name('unauthorized');


Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');
Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Route untuk menyimpan data lead
