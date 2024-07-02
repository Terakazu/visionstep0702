<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Category;

class UserQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('category')->get();
        return view('user.questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        return view('user.questions.show', compact('question'));
    }

    public function storeAnswer(Request $request, Question $question)
    {
        $request->validate([
            'answer_text' => 'required|string|max:255',
        ]);

        Answer::create([
            'answer_text' => $request->input('answer_text'),
            'question_id' => $question->id,
            'user_id' => auth()->id(), // assuming users are authenticated
        ]);

        return redirect()->route('questions.show', $question->id)->with('success', '回答が保存されました。');
    }

    public function questionsWithAnswers()
    {
        $questions = Question::with('answers.user')->get();
        return view('user.questions.with_answers', compact('questions'));
    }
    
    public function selectCategory()
    {
        $categories = Category::all();
        return view('questions.selectCategory', compact('categories'));
    }

    public function byCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $questions = Question::where('category_id', $categoryId)->get();
        return view('questions.byCategory', compact('category', 'questions'));
    }
}
