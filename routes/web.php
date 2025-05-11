<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Backend\MealController;
use App\Http\Controllers\web\Backend\MessController;
use App\Http\Controllers\Web\Backend\RoleController;
use App\Http\Controllers\Web\Backend\MarketController;
use App\Http\Controllers\Web\Backend\MemberController;
use App\Http\Controllers\Web\Backend\DashboardController;


Route::get('/', function () {
    return view('frontend.layout.index');
})->name('home');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'ensure.mess.created']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/member-list', [MemberController::class, 'index'])->name('member.list');
    Route::POST('/member-store', [MemberController::class, 'addMember'])->name('member.store');
    Route::get('/member-edit/{id}', [MemberController::class, 'editMember'])->name('member.edit');
    Route::POST('/member-update/{id}', [MemberController::class, 'updateMember'])->name('member.update');
    Route::get('/member-delete/{id}', [MemberController::class, 'deleteMember'])->name('member.delete');

    Route::get('/market', [MarketController::class, 'index'])->name('market.list');
    Route::post('/market', [MarketController::class, 'store'])->name('market.store');
    Route::get('/market/{id}/edit', [MarketController::class, 'edit']);
    Route::put('/market/{id}', [MarketController::class, 'update']);
    Route::delete('/market/{id}', [MarketController::class, 'destroy']);
    Route::get('/market/stats', [MarketController::class, 'stats']);


    Route::get('/meals', [MealController::class, 'index'])->name('meal.list');
    Route::post('/meals', [MealController::class, 'store'])->name('meals.store');

    // Routes for monthly/yearly meal data
    Route::get('/monthly', [MealController::class, 'monthlyIndex'])->name('meals.monthly');
    Route::get('/yearly', [MealController::class, 'getYearlyData'])->name('meals.yearly');

    Route::get('/api/meals/data', [MealController::class, 'getMealData'])->name('meals.data');

    Route::get('/mess', [MessController::class, 'index'])->name('mess.index');
    Route::post('/mess/store', [MessController::class, 'storeMess'])->name('mess.store');
    Route::post('/member/store', [MessController::class, 'storeMember'])->name('member.store');

    Route::resource('roles', RoleController::class);
});




require __DIR__ . '/auth.php';
