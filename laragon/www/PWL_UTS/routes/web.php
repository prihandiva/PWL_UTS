<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\StokController;


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
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level',[LevelController::class,'index']);
// Route::get('/kategori',[KategoriController::class,'index']);
// Route::get('/user',[UserController::class,'index']);
// Route::get('/user/tambah',[UserController::class,'tambah']);
// Route::post('/user/tambah_simpan',[UserController::class,'tambah_simpan']);
// Route::get('/user/ubah/{id}',[UserController::class,'ubah']);
// Route::put('/user/ubah_simpan/{id}',[UserController::class,'ubah_simpan']);
// Route::get('/user/hapus/{id}',[UserController::class,'hapus']);
// Route::get('/',[WelcomeController::class,'index']);

Route::get('/landing', [LandingPageController::class, 'index'])->name('landing');

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'postregister']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');


Route::middleware(['auth'])->group(function() {
    Route::get('/', [WelcomeController::class, 'index']);

    Route::get('/profile',[ProfileController::class,'index']);

    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']);
            Route::post('/list', [LevelController::class, 'list']);
            Route::get('/create', [LevelController::class, 'create']);
            Route::post('/', [LevelController::class, 'store']);
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
            Route::post('/ajax', [LevelController::class, 'store_ajax']);
            Route::get('/{id}/edit', [LevelController::class, 'edit']);
            Route::put('/{id}', [LevelController::class, 'update']);
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit Level Ajax
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data Level Ajax
            Route::post('/{id}', [LevelController::class, 'destroy']);
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk menampilkan form confirm delete Level Ajax
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk menghapus data level Ajax
            Route::get('/import', [LevelController::class, 'import']); 
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']);
            Route::get('/export_excel', [LevelController::class, 'export_excel']);
            Route::get('/export_pdf', [LevelController::class, 'export_pdf']);
        });
    });
    Route::middleware(['authorize:ADM,MNG'])->group(function(){

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/list', [UserController::class, 'list']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/{id}/edit', [UserController::class, 'edit']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
        Route::post('/{id}', [UserController::class, 'destroy']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk menampilkan form confirm delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk menghapus data user Ajax
        Route::get('/import', [UserController::class, 'import']); 
        Route::post('/import_ajax', [UserController::class, 'import_ajax']);
        Route::get('/export_excel', [UserController::class, 'export_excel']);
        Route::get('/export_pdf', [UserController::class, 'export_pdf']);
        Route::get('/update',[UserController::class,'update_profile']);
    });
});
    
    
    
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::post('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);
        Route::put('/{id}', [KategoriController::class, 'update']);
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // Menampilkan halaman form edit Kategori Ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // Menyimpan perubahan data Kategori Ajax
        Route::post('/{id}', [KategoriController::class, 'destroy']);
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk menampilkan form confirm delete Kategori Ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk menghapus data Kategori Ajax
        Route::get('/import', [KategoriController::class, 'import']); 
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);
        Route::get('/export_excel', [KategoriController::class, 'export_excel']);
        Route::get('/export_pdf', [KategoriController::class, 'export_pdf']);
    });
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('/list', [SupplierController::class, 'list']);
        Route::get('/create', [SupplierController::class, 'create']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);
        Route::put('/{id}', [SupplierController::class, 'update']);
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Menampilkan halaman form edit Supplier Ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Menyimpan perubahan data Supplier Ajax
        Route::post('/{id}', [SupplierController::class, 'destroy']);
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk menampilkan form confirm delete Supplier Ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk menghapus data Supplier Ajax
        Route::get('/import', [SupplierController::class, 'import']); 
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']);
        Route::get('/export_excel', [SupplierController::class, 'export_excel']);
        Route::get('/export_pdf', [SupplierController::class, 'export_pdf']);
    });
    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/list', [BarangController::class, 'list']);
        Route::get('/create', [BarangController::class, 'create']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::get('/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan halaman form edit Barang Ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Menyimpan perubahan data Barang Ajax
        Route::post('/{id}', [BarangController::class, 'destroy']);
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk menampilkan form confirm delete Barang Ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk menghapus data Barang Ajax
        Route::get('/import', [BarangController::class, 'import']); 
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']);
        Route::get('/export_excel', [BarangController::class, 'export_excel']);
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']);
    });
    Route::group(['prefix' => 'profile'], function () {
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    });
});
Route::group(['prefix' => 'stok'], function () {
        Route::get('/', [StokController::class, 'index']);
        Route::post('/list', [StokController::class, 'list']);
        Route::get('/create', [StokController::class, 'create']);
        Route::post('/', [StokController::class, 'store']);
        Route::get('/create_ajax', [StokController::class, 'create_ajax']);
        Route::post('/ajax', [StokController::class, 'store_ajax']);
        Route::get('/{id}', [StokController::class, 'show']);
        Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']);
        Route::get('/{id}/edit', [StokController::class, 'edit']);
        Route::put('/{id}', [StokController::class, 'update']);
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // Menampilkan halaman form edit Stok Ajax
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // Menyimpan perubahan data Stok Ajax
        Route::post('/{id}', [StokController::class, 'destroy']);
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // Untuk menampilkan form confirm delete Stok Ajax
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // Untuk menghapus data Stok Ajax
        Route::get('/import', [StokController::class, 'import']); 
        Route::post('/import_ajax', [StokController::class, 'import_ajax']);
        Route::get('/export_excel', [StokController::class, 'export_excel']);
        Route::get('/export_pdf', [StokController::class, 'export_pdf']);
    });
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::get('/penjualan', [PenjualanController::class, 'index']);  // menampilkan halaman penjualan
        Route::post('/penjualan/list', [PenjualanController::class, 'list'] );    //menampilkan data penjualan dalam bentuk json datatables
        Route::get('/penjualan/create_ajax', [PenjualanController::class, 'create_ajax']); //Menampilkan halaman form tambah penjualan Ajax
        Route::post('/penjualan/ajax', [PenjualanController::class, 'store_ajax']); // Menyimpan data penjualan baru Ajax 
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);       //menampilkan detai penjualan
        Route::get('/penjualan/{id}/edit_ajax', [PenjualanController::class,'edit_ajax']); //menampilkan halaman form edit penjualan ajax
        Route::put('/penjualan/{id}/update_ajax', [PenjualanController::class,'update_ajax']);   //menyimpan halaman form edit penjualan ajax
        Route::get('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']); //tampil form confirm delete penjualan ajax
        Route::delete('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']);  //hapus data penjualan
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']);     //mengahpus data penjualan
        Route::get('/penjualan/import', [PenjualanController::class, 'import']); //ajax form upolad
        Route::post('/penjualan/import_ajax', [PenjualanController::class, 'import_ajax']); //ajax import exvel)
        Route::get('/penjualan/export_excel', [PenjualanController::class, 'export_excel']);  //export excel
        Route::get('/penjualan/export_pdf', [PenjualanController::class, 'export_pdf']); //export pdf
        
        
    });
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
        Route::group(['prefix' => 'detail'], function () {
            Route::get('/', [PenjualanDetailController::class, 'index']);          // menampilkan halaman awal stok
            Route::post('/list', [PenjualanDetailController::class, 'list']);      // menampilkan data stok dalam bentuk json untuk datatables
            Route::get('/create', [PenjualanDetailController::class, 'create']);   // menampilkan halaman form tambah stok
            Route::get('/create_ajax', [PenjualanDetailController::class, 'create_ajax']);
            Route::post('/ajax', [PenjualanDetailController::class, 'store_ajax']);
            Route::post('/', [PenjualanDetailController::class, 'store']);         // menyimpan data stok baru
            Route::get('/import', [PenjualanDetailController::class, 'import']);
            Route::post('/import_ajax', [PenjualanDetailController::class, 'import_ajax']);
            Route::get('/export_excel', [PenjualanDetailController::class, 'export_excel']); // export excel
            Route::get('/export_pdf', [PenjualanDetailController::class, 'export_pdf']); // export pdf
            Route::get('/{id}', [PenjualanDetailController::class, 'show']);       // menampilkan detail stok
            Route::get('/penjualan/detail/{id}/show_ajax', [PenjualanDetailController::class, 'show_ajax']);
            Route::get('/{id}/edit', [PenjualanDetailController::class, 'edit']);  // menampilkan halaman form edit stok
            Route::put('/{id}', [PenjualanDetailController::class, 'update']);     // menyimpan perubahan data stok
            Route::get('/penjualan/detail/{id}/edit_ajax', [PenjualanDetailController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [PenjualanDetailController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [PenjualanDetailController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [PenjualanDetailController::class, 'delete_ajax']);
            Route::delete('/{id}', [PenjualanDetailController::class, 'destroy']); // menghapus data stok
        });
    
    });
    
//logout
use Illuminate\Support\Facades\Auth;
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/landing');
})->name('logout');

Route::group(['prefix' => 'profile', 'middleware'=>'authorize:ADM,MNG,STF,CST'], function(){
    Route::get('/', [ProfileController::class, 'index']);
    Route::get('/{id}/edit_ajax', [ProfileController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [ProfileController::class, 'update_ajax']);
    Route::get('/{id}/edit_foto', [ProfileController::class, 'edit_foto']);
    Route::put('/{id}/update_foto', [ProfileController::class, 'update_foto']);
});



