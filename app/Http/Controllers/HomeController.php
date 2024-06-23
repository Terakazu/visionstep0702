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
          // ページネーション可能なビジョンボードのリストを取得（1ページあたり10件）
    $visionboards = Visionboard::with('elements')->paginate(10);

        // 最新のビジョンボードを取得
        $latestVisionboard = Visionboard::with('elements')->latest()->first();
        

        // ビューにデータを渡す
        return view('home', compact('visionboards', 'latestVisionboard'));
    } 
    //
}
