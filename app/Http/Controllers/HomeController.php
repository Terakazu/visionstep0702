<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visionboard;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;

class HomeController extends Controller
{
    /**
     * トップページを表示する.
     *
     * @return \Illuminate\View\View
     */
  public function index(Request $request)
{
    // 認証されたユーザーの取得
    $user = Auth::user();
    
    // 認証されたユーザーのビジョンボードを作成日時の降順で取得し、ページネート
    $visionboards = Visionboard::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(3); // ページネートの数を3に設定
    
    // 最新のビジョンボードを個別に取得
    $latestVisionboard = Visionboard::where('user_id', $user->id)
        ->latest()
        ->first();
        
    // 最新の目標を取得
    $latestGoal = Goal::where('user_id', $user->id)->latest()->first();

    return view('home', compact('latestVisionboard', 'visionboards', 'latestGoal'));
}
}