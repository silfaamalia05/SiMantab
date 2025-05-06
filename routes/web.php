<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BatasKabKotaController;
use App\Http\Controllers\BatasKecDesaController;
use App\Http\Controllers\BatasKelDesaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBanjirController;
use App\Http\Controllers\InfrastrukturController;
use App\Http\Controllers\JaringanSungaiController;
use App\Http\Controllers\JenisTanahController;
use App\Http\Controllers\KapasitasBanjirController;
use App\Http\Controllers\KategoriLogistikController;
use App\Http\Controllers\KawasanPemukimanController;
use App\Http\Controllers\KelerenganController;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\MorfologiController;
use App\Http\Controllers\PotensiKerugianController;
use App\Http\Controllers\PotensiPendudukTerpaparController;
use App\Http\Controllers\ReportPdfController;
use App\Http\Controllers\RequestUserController;
use App\Http\Controllers\TabulasiBahayaBanjirController;
use App\Http\Controllers\TabulasiResikoBanjirController;
use App\Models\KategoriLogistik;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

use App\Http\Controllers\ReportController;

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login-page', function () {
    return view('auth.login');
})->name('login-page');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/register-user', [RegisterController::class, 'create'])->name('register-user');

Route::middleware(['auth'])->group(function () {
    Route::get('/reports/generate-pdf/{format}/{id}', [ReportPdfController::class, 'generate'])->name('reports.generate');
    Route::post('/reports/generateAsCheck', [ReportPdfController::class, 'generateAsCheck'])->name('reports.generateAsCheck');
    Route::post('/reports/generateAsPriority', [ReportPdfController::class, 'generateAsPriority'])->name('reports.generateAsPriority');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('batas_kab_kota',BatasKabKotaController::class);
    Route::resource('batas_kec_desa',BatasKecDesaController::class);
    Route::resource('batas_kel_desa',BatasKelDesaController::class);
    Route::resource('jaringan_sungai',JaringanSungaiController::class);
    Route::resource('jenis_tanah',JenisTanahController::class);
    Route::resource('morfologi',MorfologiController::class);
    Route::resource('kelerengan',KelerenganController::class);
    Route::resource('kawasan_pemukiman',KawasanPemukimanController::class);

    Route::resource('infrastruktur',InfrastrukturController::class);
    Route::resource('data_banjir',DataBanjirController::class);
    Route::resource('kategori_logistik',KategoriLogistikController::class);
    Route::resource('logistik',LogistikController::class);
    Route::get('print_logistik',[LogistikController::class,'print'])->name('logistik.print_pdf');

    // Tabulasi
    Route::get('/kapasitas_banjir', [KapasitasBanjirController::class,'index'])->name('kapasitas_banjir');
    Route::get('/kapasitas_banjir/{id}/form', [KapasitasBanjirController::class,'form'])->name('kapasitas_banjir.form');
    Route::post('/kapasitas_banjir/set', [KapasitasBanjirController::class,'set'])->name('kapasitas_banjir.set');

    Route::get('/potensi_kerugian', [PotensiKerugianController::class,'index'])->name('potensi_kerugian');
    Route::get('/potensi_kerugian/{id}/form', [PotensiKerugianController::class,'form'])->name('potensi_kerugian.form');
    Route::post('/potensi_kerugian/set', [PotensiKerugianController::class,'set'])->name('potensi_kerugian.set');

    Route::get('/potensi_penduduk_terpapar', [PotensiPendudukTerpaparController::class,'index'])->name('potensi_penduduk_terpapar');
    Route::get('/potensi_penduduk_terpapar/{id}/form', [PotensiPendudukTerpaparController::class,'form'])->name('potensi_penduduk_terpapar.form');
    Route::post('/potensi_penduduk_terpapar/set', [PotensiPendudukTerpaparController::class,'set'])->name('potensi_penduduk_terpapar.set');

    Route::get('/tabulasi_bahaya', [TabulasiBahayaBanjirController::class,'index'])->name('tabulasi_bahaya');
    Route::get('/tabulasi_bahaya/{id}/form', [TabulasiBahayaBanjirController::class,'form'])->name('tabulasi_bahaya.form');
    Route::post('/tabulasi_bahaya/set', [TabulasiBahayaBanjirController::class,'set'])->name('tabulasi_bahaya.set');

    
    Route::get('/tabulasi_resiko', [TabulasiResikoBanjirController::class,'index'])->name('tabulasi_resiko');
    Route::get('/tabulasi_resiko/{id}/form', [TabulasiResikoBanjirController::class,'form'])->name('tabulasi_resiko.form');
    Route::post('/tabulasi_resiko/set', [TabulasiResikoBanjirController::class,'set'])->name('tabulasi_resiko.set');

    Route::prefix('reports')->group(function(){
        Route::get('/',[ReportController::class,'index'])->name('reports.index');
        Route::get('/create', [ReportController::class, 'create'])->name('reports.create');
        Route::get('/{id}/edit',[ReportController::class,'edit'])->name('reports.edit');
        Route::post('/store', [ReportController::class, 'store'])->name('reports.store');
        Route::put('/{id}/update', [ReportController::class, 'update'])->name('reports.update');
        Route::delete('/uri: {id}/destroy', [ReportController::class, 'destroy'])->name('reports.destroy');
        Route::get('/{id}/delete_images',[ReportController::class,'deleteImages'])->name('reports.deleteImages');
    });
   
    Route::get('/laporan',[ReportController::class,'formPelaporan'])->name('laporan.index');
    Route::post('/laporan/store',[ReportController::class,'storePelaporan'])->name('laporan.store');


    Route::get('/actions', [ActionController::class, 'index'])->name('actions.index');

    Route::get('/request-users', [RequestUserController::class, 'index'])->name('request_users.index');
    Route::put('/request-users/{id}/approve', [RequestUserController::class, 'approve'])->name('request_users.approve');
    Route::put('/request-users/{id}/decline', [RequestUserController::class, 'decline'])->name('request_users.decline');
});
