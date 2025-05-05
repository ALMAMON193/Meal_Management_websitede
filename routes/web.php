<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Backend\RoleController;
use App\Http\Controllers\Web\Backend\MarketController;
use App\Http\Controllers\Web\Backend\MemberController;
use App\Http\Controllers\Web\frontend\MarketItemController;

Route::get('/', function () {
    return view('frontend.layout.index');
})->name('home');


Route::get('/dashboard', function () {
    return view('backend.layout.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/member-list', [MemberController::class, 'index'])->name('member.list');
    Route::POST('/member-store', [MemberController::class, 'addMember'])->name('member.store');
    Route::get('/member-edit/{id}', [MemberController::class, 'editMember'])->name('member.edit');
    Route::POST('/member-update/{id}', [MemberController::class, 'updateMember'])->name('member.update');
    Route::get('/member-delete/{id}', [MemberController::class, 'deleteMember'])->name('member.delete');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/market-list', [MarketController::class, 'index'])->name('market.list');
    Route::POST('/market-store', [MarketController::class, 'store'])->name('market.store');
    Route::POST('/market-update/{id}', [MarketController::class, 'update'])->name('market.update');
    Route::get('/market-delete/{id}', [MarketController::class, 'destroy'])->name('market.delete');
});
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
});




require __DIR__.'/auth.php';
