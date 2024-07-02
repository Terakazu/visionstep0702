<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visionboard;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * トップページを表示する.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
           // 認証されたユーザーのビジョンボードを作成日時の降順で取得し、ページネート
        $visionboards = Visionboard::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        // 最新のビジョンボードを個別に取得
        $latestVisionboard = Visionboard::where('user_id', Auth::user()->id)
            ->latest()
            ->first();

        return view('home', compact('latestVisionboard', 'visionboards'));
    }
    
}
