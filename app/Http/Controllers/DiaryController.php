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
       $diaries = Diary::all();
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
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
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
        return view('diaries.show', compact('diary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diary $diary)
    {
        return view('diaries.edit', compact('diary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diary $diary)
    {
      $request->validate([
            'calendar_date' => 'required|date',
            'body' => 'required',
            'goodpoint' => 'required',
        ]);

        $diary->update($request->all());

        return redirect()->route('diaries.index')
                        ->with('success', 'Diary updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diary $diary)
    {
      $diary->delete();

        return redirect()->route('diaries.index')
                        ->with('success', 'Diary deleted successfully.');
    }
}
