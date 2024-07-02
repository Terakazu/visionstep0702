<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
          $categories = Category::all(); // カテゴリーを全て取得
    return view('admin.categories.index', compact('categories')); // ビューに渡す
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view ('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // バリデーションの追加
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // 新しいカテゴリーの作成
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->save();

        // 保存後、リダイレクトする
        return redirect()->route('admin.categories.index')->with('success', 'カテゴリーが作成されました');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category) {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'カテゴリーが削除されました。');
        } else {
            return redirect()->route('admin.categories.index')->with('error', 'カテゴリーが見つかりませんでした。');
        }
    }
}


