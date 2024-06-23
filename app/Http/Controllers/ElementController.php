<?php

namespace App\Http\Controllers;

use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Visionboard; // Visionboard モデルを使用する場合には追加

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Visionboard $visionboard)
    {
        // ビジョンボードIDに紐づく要素を取得
        $elements = Element::where('visionboard_id', $visionboard->id)->get();

        // ビューにビジョンボードIDも渡しておく
        return view('elements.index', compact('elements', 'visionboard'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Visionboard $visionboard)
{
    // $visionboard_idを使用してビジョンボードを取得する
 return view('elements.create', compact('visionboard'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Visionboard $visionboard)
    {
   
        $request->validate([
            'element_type'=>'required|min:2|max:255',
            'element_data'=>'nullable|min:2|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position_x'=>'required',
            'position_y'=>'required',
        ]);
        
          if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        
         // ディレクトリの存在を確認
        $imagePath = public_path('images');
        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0777, true); // ディレクトリがない場合は作成
        }
        
        $request->image->move($imagePath, $imageName);
    } else {
        $imageName = null; // 画像がアップロードされていない場合は null を設定
    }

    $element = Element::create([
        'element_type' => $request->element_type,
        'element_data' => $request->element_data,
        'image' => $imageName,
        'position_x' => $request->position_x,
        'position_y' => $request->position_y,
        'visionboard_id' => $visionboard->id,
    ]);

    if ($element) {
        // 作成された要素の詳細ページにリダイレクト
        return redirect()->route('visionboards.elements.index', ['visionboard' => $visionboard->id])
                         ->with('success', 'Element has been created successfully.');
    } else {
        return back()->with('error', 'Failed to create element.');
    }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Visionboard $visionboard)
    {
        /// ビジョンボードに関連する要素を取得
        $elements = $visionboard->elements;

        // ビューにデータを渡す
        return view('visionboards.elements.show', compact('visionboard'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visionboard $visionboard, Element $element)
    {
        // 指定された要素の編集フォームを表示
        return view('elements.edit', compact('visionboard', 'element'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visionboard $visionboard, Element $element)
    {
        $request->validate([
        'element_type' => 'required|string|max:255',
        'element_data' => 'nullable|string|max:255',
        'position_x' => 'required|numeric',
        'position_y' => 'required|numeric',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $element->image = $imageName;
    }

    $element->element_type = $request->element_type;
    $element->element_data = $request->element_data;
    $element->position_x = $request->position_x;
    $element->position_y = $request->position_y;

    $element->save();

      return redirect()->route('visionboards.elements.index', ['visionboard' => $visionboard->id])
                         ->with('success', 'Element updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visionboard $visionboard,Element $element)
    {
       $visionboardId = $element->visionboard_id; // 削除する要素のビジョンボードIDを取得

    $element->delete();

    // visionboardId を指定して elements.index ルートにリダイレクト
     return redirect()->route('visionboards.elements.index', ['visionboard' => $visionboardId])
                         ->with('success', 'Element deleted successfully');
    }
}
