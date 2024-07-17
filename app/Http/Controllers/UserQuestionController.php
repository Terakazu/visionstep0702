<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Category;
use Illuminate\Support\Facades\Auth; // ここを追加

class UserQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('category')->get();
        return view('user.questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        // 認証されたユーザーの回答のみを取得
        $userAnswers = $question->answers()->where('user_id', auth()->id())->get();
        return view('user.questions.show', compact('question','userAnswers'));
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
        // 認証されたユーザーの回答のみを含む質問を取得
        $questions = Question::with(['answers' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->get();
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
        
        // 認証されたユーザーの回答のみを取得
        $userAnswers = Answer::where('user_id', auth()->id())
                             ->whereIn('question_id', $questions->pluck('id'))
                             ->get()
                             ->groupBy('question_id');
                             
        return view('questions.byCategory', compact('category', 'questions'));
    }
    public function userAnswers()
    {
        // 認証されたユーザーの回答を取得し、最新順に並べてページネート
        $userAnswers = Answer::where('user_id', Auth::id())
                             ->with(['question.category']) // カテゴリーを含めてロード
                             ->orderBy('created_at', 'desc')
                             ->paginate(5);

        return view('user.answers.index', compact('userAnswers'));
    }
}