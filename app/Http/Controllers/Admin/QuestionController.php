<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // カテゴリーとその関連する質問を取得
        $categories = Category::with('questions')->get();
        return view('admin.questions.index', compact('categories'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
  public function create(Category $category)
    {
        return view('admin.questions.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        // データの保存
        $question = new Question();
        $question->question_text = $request->input('question_text');
        $question->category_id = $request->input('category_id');  // category_id を設定
        $question->save();

        return redirect()->route('admin.questions.index')->with('success', '質問が作成されました');
    }
    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
        ]);

        // データの更新
        $question->question_text = $request->input('question_text');
        $question->save();

        return redirect()->route('admin.questions.index')->with('success', '質問が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')->with('success', '質問が削除されました');
    }
}
