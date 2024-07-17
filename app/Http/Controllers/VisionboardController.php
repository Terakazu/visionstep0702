<?php

namespace App\Http\Controllers;

use App\Models\Visionboard;
use App\Models\Element; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //この2行を追加！
use Illuminate\Support\Facades\Auth;      //この2行を追加！
use Illuminate\Support\Facades\Log; // ログ出力用

class VisionboardController extends Controller
{
    /**
     * Display a listing of the resource.
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

        return view('visionboards', compact('latestVisionboard', 'visionboards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 作成フォームの表示
        return view('visionboards.create');
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

        return redirect()->route('visionboards.elements.create', ['visionboard' => $visionboard->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // ビジョンボードを取得して表示するための処理
        $visionboard = Visionboard::with('elements')->find($id);

        // ビジョンボードが見つからない場合、404エラーを返す
        if (!$visionboard) {
            abort(404, 'Visionboard not found');
        }

        return view('visionboards.show', compact('visionboard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 認証されたユーザーのビジョンボードを取得
        $visionboard = Visionboard::where('user_id', Auth::user()->id)->find($id);

        // ビジョンボードが見つからない場合、404エラーを返す
        if (!$visionboard) {
            abort(404, 'Visionboard not found');
        }

        return view('visionboards.edit', ['visionboard' => $visionboard]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'board_name' => 'required|min:1|max:255',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/visionboards/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        }

        // データ更新
        $visionboard = Visionboard::where('user_id', Auth::user()->id)->find($id);
        
        // ビジョンボードが見つからない場合、404エラーを返す
        if (!$visionboard) {
            abort(404, 'Visionboard not found');
        }
        
        $visionboard->board_name = $request->board_name;
        $visionboard->save();

       // visionboards.elements.createルートへの正しいリダイレクト
    return redirect()->route('visionboards.elements.create', ['visionboard' => $visionboard->id]);
}
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visionboard = Visionboard::where('user_id', Auth::user()->id)->find($id);

        // ビジョンボードが見つからない場合、404エラーを返す
        if (!$visionboard) {
            abort(404, 'Visionboard not found');
        }

        $visionboard->delete();

        return redirect()->route('visionboards.index')->with('status', 'ビジョンボードが削除されました。');
}
    /**
     * Update the positions of the vision board elements.
     */
    public function updatePositions(Request $request)
    {
        try {
            $positions = $request->input('positions');
            Log::info('Received positions:', $positions);

            foreach ($positions as $position) {
                $element = Element::find($position['id']); // VisionBoardElementではなくElementモデルを使用
                if ($element) {
                    $element->position_x = $position['position_x'];
                    $element->position_y = $position['position_y'];
                    $element->save();
                    Log::info('Updated element ID: ' . $element->id . ' to position X: ' . $element->position_x . ', Y: ' . $element->position_y);
                } else {
                    Log::error('Element not found with ID: ' . $position['id']);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error updating positions: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}