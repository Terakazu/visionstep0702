<?php

namespace App\Http\Controllers;

use App\Models\Visionboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //この2行を追加！
use Illuminate\Support\Facades\Auth;      //この2行を追加！

class VisionboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // 認証されたユーザーのビジョンボードを作成日時の降順で取得し、3件ずつページネート
    $visionboards = Visionboard::where('user_id', Auth::user()->id)
    ->orderBy('created_at', 'desc')
    ->paginate(5);
    // 最新のビジョンボードを個別に取得
    $latestVisionboard = Visionboard::where('user_id', Auth::user()->id)
    ->latest()
    ->first();

    return view('visionboards', compact('latestVisionboard', 'visionboards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
  
          // バリデーション
    $validator = Validator::make($request->all(), [
        'board_name' => 'required|min:1|max:255',
    ]);

    // バリデーション:エラー
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // ログインしているユーザーを取得
    $user = Auth::user();

    // Eloquentモデルでのデータ登録
    $visionboard = new Visionboard;
    $visionboard->board_name = $request->board_name;
    $visionboard->user_id = $user->id; // ログインユーザーのIDを設定
    $visionboard->save();

    return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // ビジョンボードを取得して表示するための処理
        $visionboard = Visionboard::find($id);
        return view('visionboards.show', compact('visionboard'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($visionboard_id)
    {
         // 認証されたユーザーのビジョンボードを取得
    $visionboard = Visionboard::where('user_id', Auth::user()->id)->find($visionboard_id);

    // ビジョンボードが見つからない場合、404エラーを返す
    if (!$visionboard) {
        abort(404, 'Visionboard not found');
    }

    return view('visionboardsedit', ['visionboard' => $visionboard]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visionboard $visionboard)
    {
        $visionboards = Visionboard::where('user_id',Auth::user()->id)->find($request->id);
        //バリデーション
         $validator = Validator::make($request->all(), [
             'id' => 'required',
             'board_name' => 'required|min:1|max:255',
             
        ]);
        //バリデーション:エラー
         if ($validator->fails()) {
             return redirect('/visionboardsedit/'.$request->id)
                 ->withInput()
                 ->withErrors($validator);
        }
        
        //データ更新
        $visionboards = Visionboard::find($request->id);
        $visionboards->board_name   = $request->board_name;
        $visionboards->save();
        return redirect('/');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visionboard $visionboard)
    {
       $visionboard->delete();       //追加
       return redirect('/');  //追加
    }
}
