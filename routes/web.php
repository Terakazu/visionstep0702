<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisionboardController;
use App\Http\Controllers\UserQuestionController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;

use App\Http\Controllers\QuestionController;

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
    Route::post('/visionboards/elements/update-positions', [VisionBoardController::class, 'updatePositions'])->name('visionboards.elements.updatePositions');

    Route::get('/questions', [UserQuestionController::class, 'index'])->name('questions.index');
    Route::get('/questions/{question}', [UserQuestionController::class, 'show'])->name('questions.show');
    Route::post('/questions/{question}/answers', [UserQuestionController::class, 'storeAnswer'])->name('answers.store');
    Route::get('/questions-with-answers', [UserQuestionController::class, 'questionsWithAnswers'])->name('questions.with.answers');
    

    Route::get('/categories', [UserQuestionController::class, 'selectCategory'])->name('categories.select');
    Route::get('/categories/{categoryId}/questions', [UserQuestionController::class, 'byCategory'])->name('questions.byCategory');
    
    Route::resource('diaries', DiaryController::class);
    
    Route::resource('goals', GoalController::class);
    
    
    // ビジョンボード内の要素関連
    Route::prefix('visionboards')->group(function () {
        Route::get('{visionboard}/elements/create', [ElementController::class, 'create'])->name('visionboards.elements.create');
        Route::get('{visionboard}/elements', [ElementController::class, 'index'])->name('visionboards.elements.index');
        Route::get('{visionboard}/elements/{element}/edit', [ElementController::class, 'edit'])->name('visionboards.elements.edit');
        Route::post('{visionboard}/elements', [ElementController::class, 'store'])->name('visionboards.elements.store');
        Route::put('{visionboard}/elements/{element}', [ElementController::class, 'update'])->name('visionboards.elements.update');
        Route::delete('{visionboard}/elements/{element}', [ElementController::class, 'destroy'])->name('visionboards.elements.destroy');
        Route::post('{visionboard}/elements/update-positions', [ElementController::class, 'savePositions'])->name('visionboards.elements.savePositions');
    
    });

});

    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        Route::resource('categories', AdminCategoryController::class);
        Route::get('questions/create/{category}', [AdminQuestionController::class, 'create'])->name('questions.create');
        Route::post('questions/store', [AdminQuestionController::class, 'store'])->name('questions.store'); // ストアメソッドのルート
        Route::resource('questions', AdminQuestionController::class)->except(['create', 'store']); // その他のリソースルート
    });


// 認証関連のルート
require __DIR__.'/auth.php';
