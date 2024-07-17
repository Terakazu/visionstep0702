<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;  

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diaries = Diary::where('user_id', auth()->id())->get();
        return view('diaries.index', compact('diaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'calendar_date' => 'required|date',
            'body' => 'required',
            'goodpoint' => 'required',
            'image' => 'nullable|image|max:2048', // 画像は任意
        ]);

       $data = $request->all();
        $data['user_id'] = Auth::id(); // user_idを明示的に設定
        
        if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();

         // ディレクトリの存在を確認
        $imagePath = public_path('images');
        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0777, true); // ディレクトリがない場合は作成
        }
        
        $request->image->move($imagePath, $imageName);
        $data['image'] =  $imageName; // 保存パスを設定
    }
    

    Diary::create($data);

    return redirect()->route('diaries.index')
                     ->with('success', 'Diary created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Diary $diary)
    {
        if ($diary->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    return view('diaries.show', compact('diary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diary $diary)
{
    if ($diary->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    return view('diaries.edit', compact('diary'));
}

public function update(Request $request, Diary $diary)
{
    if ($diary->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    $diary->update($request->all());
    return redirect()->route('diaries.index')->with('success', 'Diary updated successfully.');
}

public function destroy(Diary $diary)
{
    if ($diary->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    $diary->delete();
    return redirect()->route('diaries.index')->with('success', 'Diary deleted successfully.');
}

}
