<?php

use App\Models\PerformaHarian;
use App\Models\PerformanceBulanan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientMBController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientLayananController;
use App\Http\Controllers\DasboardAdminController;
use App\Http\Controllers\PerformaHarianController;
use App\Http\Controllers\ClientInformationController;
use App\Http\Controllers\LaporanHarianLeadController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PerformanceBulananController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/', function () {
    return redirect('/sign-in');
});

// Rute Login
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [LoginController::class, 'create'])->name('sign-in');
    Route::post('/sign-in', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Admin (1): semua route
    Route::middleware(['checkUserRole:1'])->group(function () {
        Route::resource('/acount', UserController::class);
        Route::get('/version', [UserController::class, 'version'])->name('marketlab.version');
        Route::post('/acount/reset-password/{id}', [UserController::class, 'resetPassword'])->name('acount.reset-password.reset');
    });

    // Admin, C-Level, Marketing (1,2,3): semua route kecuali akun
    Route::middleware(['checkUserRole:1,2,3'])->group(function () {
        Route::get('/dashboard', [DasboardAdminController::class, 'index'])->name('dashboard');
        Route::resource('/clients', ClientController::class);
        Route::get('/dashboard-marketing', [DasboardAdminController::class, 'dasboar_marketing'])->name('dashboard.marketing');
        Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
        Route::get('/marketing/layanan/{id}', [MarketingController::class, 'edit'])->name('marketing.edit');
        Route::put('/marketing/layanan/{id}/edit', [MarketingController::class, 'update'])->name('marketing.update');
        Route::post('/client-layanan', [ClientLayananController::class, 'store'])->name('client_layanan.store');
        Route::get('/get-available-layanan/{clientId}', [MarketingController::class, 'getAvailableLayanan']);
    });

    // Head-SA (4)
    Route::middleware(['checkUserRole:1,2,3,4'])->group(function () {
        Route::get('/dashboard-sa', [DasboardAdminController::class, 'dasboar_sa'])->name('dashboard.sa');
    });

    // PIC-SA (5)
    Route::middleware(['checkUserRole:1,2,3,4,5'])->group(function () {
        Route::get('/list-client-sa', [SaController::class, 'indexList'])->name('list-client-sa.index');
        Route::get('/divisi-sa/{client_id}', [SaController::class, 'index'])->name('divisi-sa.index');
        Route::put('/divisi-sa/{client_id}/{post_id}', [SaController::class, 'update'])->name('divisi-sa.update');
        Route::post('/divisi-sa/store/{client_id}', [SaController::class, 'store'])->name('divisi-sa.store');
        Route::post('/divisi-sa/store-tiktok/{client_id}', [SaController::class, 'storeTiktok'])->name('divisi-sa.storeTiktok');
        Route::put('/divisi-sa/update-tiktok/{client_id}/{post_id}', [SaController::class, 'updateTiktok'])->name('divisi-sa.updateTiktok');
        Route::post('/divisi-sa/profile/{client_id}', [SaController::class, 'storeProfile'])->name('divisi-sa.storeProfile');
        Route::post('/divisi-sa/profile-tiktok/{client_id}', [SaController::class, 'storeProfileTiktok'])->name('divisi-sa.storeProfileTiktok');
        Route::put('/divisi-sa/profile/{client_id}/update', [SaController::class, 'updateProfile'])->name('divisi-sa.updateProfile');
        Route::get('/divisi-sa/profile/{client_id}/edit', [SaController::class, 'editProfile'])->name('divisi-sa.editProfile');
        Route::get('/divisi-sa/profile-tiktok/{client_id}/edit', [SaController::class, 'editProfileTiktok'])->name('divisi-sa.editProfileTiktok');
        Route::put('/divisi-sa/profile-tiktok/{client_id}/update', [SaController::class, 'updateProfileTiktok'])->name('divisi-sa.updateProfileTiktok');
        Route::delete('/divisi-sa/{client_id}/instagram/{post_id}', [SaController::class, 'deleteInstagram'])->name('divisi-sa.deleteInstagram');
        Route::delete('/divisi-sa/{client_id}/tiktok/{post_id}', [SaController::class, 'deleteTiktok'])->name('divisi-sa.deleteTiktok');
    });

    // Head-MB (7)
    Route::middleware(['checkUserRole:1,2,3,7'])->group(function () {
        Route::get('/dashboard-mb', [DasboardAdminController::class, 'dasboar_mb'])->name('dashboard.mb');
        Route::post('/dashboard-mb/chart-data', [DasboardAdminController::class, 'getChartData'])->name('dashboard.mb.chart-data');
    });

    // PIC-MB (8)
    Route::middleware(['checkUserRole:1,2,3,7,8'])->group(function () {
        Route::get('/laporan-harian/leads', [LaporanHarianLeadController::class, 'index'])->name('laporan-harian.index-lead');
        Route::post('/lead/store', [LaporanHarianLeadController::class, 'store'])->name('lead.store');
        Route::put('/lead/{id}', [LaporanHarianLeadController::class, 'update'])->name('lead.update');
        Route::get('/clients-mb', [ClientMBController::class, 'index'])->name('clients-mb.index');
        Route::resource('/laporan-bulanan', PerformanceBulananController::class);
        Route::resource('/laporan-harian', PerformaHarianController::class);
        Route::delete('/laporan-harian-lead/{id}', [LaporanHarianLeadController::class, 'destroy'])->name('laporan-harian-lead.destroy');
        Route::post('/laporan-bulanan/compare', [PerformanceBulananController::class, 'compareView'])->name('laporan-bulanan.compare'); //bukan ini
        Route::get('/performa-harian/compare', [PerformaHarianController::class, 'compare'])->name('performa-harian.compare');
        Route::post('/laporan-harian/store-lead', [PerformaHarianController::class, 'store_lead'])->name('laporan-harian.store-lead');
        Route::put('/laporan-harian/update-lead/{id}', [PerformaHarianController::class, 'updateLead'])->name('laporan-harian.update_lead');
        Route::delete('/laporan-harian/delete_lead/{id}', [PerformaHarianController::class, 'destroy_lead'])->name('laporan-harian.destroy_lead');
    });

    //  Client (6)
    Route::middleware(['checkUserRole:6', 'encryptDecrypt'])->group(function () {
        // Log::info('User with role_id 6 accessed the route.');
        Route::get('data-client/performa-harian/compare', [ClientInformationController::class, 'compare']);
        Route::get('/data-client', [ClientInformationController::class, 'index'])->name('data-client.index');
        Route::get('/data-client/{client_id}/{layanan}', [ClientInformationController::class, 'bulanan'])->name('data-client.laporan-bulanan');
        Route::get('/data-client/laporan-bulan', [ClientInformationController::class, 'prosesLayananA'])->name('data-client.laporan-bulan');
        Route::get('/data-client/laporan-harian', [ClientInformationController::class, 'harian'])->name('data-client.laporan-harian');
        Route::get('/data-client/laporan-harian-lead', [ClientInformationController::class, 'harianLead'])->name('data-client.laporan-harian-lead');
        Route::put('/data-client/laporan-harian/update-lead/{id}', [ClientInformationController::class, 'updateHarianLead'])->name('data-client.update-harian-lead');
        Route::put('/data-client/{client_id}/divisi-sa/{post_id}', [ClientInformationController::class, 'update'])->name('data-client.update-sa');
        Route::put('/data-client/{client_id}/tiktok/{post_id}', [ClientInformationController::class, 'updateTiktok'])->name('data-client.update-tiktok');
    });
});

// Unauthorized Page
Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');
