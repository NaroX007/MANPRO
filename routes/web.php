<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampGroundController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\TipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/detailcamp/{camp_ground}', [CampGroundController::class, 'show'])->name('detailcamp');;
Route::get('/tip/{id}', [TipController::class, 'show'])->name('detailtip');;
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('detailartikel');;


Route::get('/homel', [CampGroundController::class, 'publikindex'])->name('home'); 


Route::get('/tips', [TipController::class, 'publikindex'])->name('tip'); 


Route::get('/artikel', [ArtikelController::class, 'publikindex'])->name('artikel'); 


route::get('/campground/kategori', [CampGroundController::class, 'kategori'])->name('kategori');
route::get('/campground', [CampGroundController::class, 'allindex'])->name('campground');



Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard/camp', [CampGroundController::class, 'index'])->name('camp.index'); 
    Route::get('/dashboard/camp/create', [CampGroundController::class, 'create'])->name('camp.create');
    Route::get('/dashboard/camp/{id}/edit', [CampGroundController::class, 'edit'])->name('camp.edit'); 
    Route::post('/dashboard/camp', [CampGroundController::class, 'store'])->name('camp.store');
    Route::put('/dashboard/camp/{id}', [CampGroundController::class, 'update'])->where('id', '[0-9]+')->name('camp.update'); 
    Route::delete('/dashboard/camp/{id}', [CampGroundController::class, 'destroy'])->where('id', '[0-9]+')->name('camp.destroy');

    Route::get('/dashboard/artikel', [ArtikelController::class, 'index'])->name('artikel.index'); 
    Route::get('/dashboard/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::get('/dashboard/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit'); 
    Route::post('/dashboard/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::put('/dashboard/artikel/{id}', [ArtikelController::class, 'update'])->where('id', '[0-9]+')->name('artikel.update'); 
    Route::delete('/dashboard/artikel/{id}', [ArtikelController::class, 'destroy'])->where('id', '[0-9]+')->name('artikel.destroy');

    Route::get('/dashboard/tip', [TipController::class, 'index'])->name('tip.index'); 
    Route::get('/dashboard/tip/create', [TipController::class, 'create'])->name('tip.create');
    Route::get('/dashboard/tip/{id}/edit', [TipController::class, 'edit'])->name('tip.edit'); 
    Route::post('/dashboard/tip', [TipController::class, 'store'])->name('tip.store');
    Route::put('/dashboard/tip/{id}', [TipController::class, 'update'])->where('id', '[0-9]+')->name('tip.update'); 
    Route::delete('/dashboard/tip/{id}', [TipController::class, 'destroy'])->where('id', '[0-9]+')->name('tip.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
