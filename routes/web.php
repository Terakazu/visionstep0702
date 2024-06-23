<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisionboardController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;

// ログインが必要なルート
Route::middleware(['auth'])->group(function () {

    // ダッシュボード表示
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/login', [CustomAuthenticatedSessionController::class, 'store']);

    // プロファイル関連
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   /// ビジョンボード関連
   Route::get('/visionboards/{visionboard}', [VisionboardController::class, 'show'])->name('visionboards.show');
    Route::post('/visionboards', [VisionboardController::class, 'store'])->name('visionboard_store');
    Route::delete('/visionboards/{visionboard}', [VisionboardController::class, 'destroy'])->name('visionboard_destroy');
    Route::get('/visionboards/{visionboard}/edit', [VisionboardController::class, 'edit'])->name('visionboard_edit');
    Route::put('/visionboards/{visionboard}', [VisionboardController::class, 'update'])->name('visionboard_update');
     Route::get('/visionboard/{visionboard}', [VisionboardController::class, 'show'])->name('visionboards.show');
    
    // ビジョンボード内の要素関連
    Route::prefix('visionboards')->group(function () {
        Route::get('{visionboard}/elements/create', [ElementController::class, 'create'])->name('visionboards.elements.create');
        Route::get('{visionboard}/elements', [ElementController::class, 'index'])->name('visionboards.elements.index');
        Route::get('{visionboard}/elements/{element}/edit', [ElementController::class, 'edit'])->name('visionboards.elements.edit');
        Route::post('{visionboard}/elements', [ElementController::class, 'store'])->name('visionboards.elements.store');
        Route::put('{visionboard}/elements/{element}', [ElementController::class, 'update'])->name('visionboards.elements.update');
        Route::delete('{visionboard}/elements/{element}', [ElementController::class, 'destroy'])->name('visionboards.elements.destroy');
    
    });


});

// 認証関連のルート
require __DIR__.'/auth.php';
