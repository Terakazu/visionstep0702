<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'deadline' => 'required|date',
            'condition' => 'required|string|max:255',
            'action' => 'required|string',
        ]);

        Goal::create([
            'user_id' => auth()->id(),
            'deadline' => $request->deadline,
            'condition' => $request->condition,
            'action' => $request->action,
        ]);

        return redirect()->route('goals.index')->with('success', '目標が作成されました');
    }

    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        $request->validate([
            'deadline' => 'required|date',
            'condition' => 'required|string|max:255',
            'action' => 'required|string',
        ]);

        $goal->update([
            'deadline' => $request->deadline,
            'condition' => $request->condition,
            'action' => $request->action,
        ]);

        return redirect()->route('goals.index')->with('success', '目標が更新されました');
    }

    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();

        return redirect()->route('goals.index')->with('success', '目標が削除されました');
    }
    
   public function updateSelectedGoal(Request $request)
    {
        // リクエスト内容をダンプして表示
        \Log::info('Request data:', $request->all());

        // 現在のユーザーを取得
        $user = Auth::user();
        \Log::info('Authenticated user:', ['id' => $user->id]);

        // すべての目標の is_selected を false にリセット
        $reset = Goal::where('user_id', $user->id)->update(['is_selected' => false]);
        \Log::info('Reset is_selected for all goals:', ['affected_rows' => $reset]);

        // 選択された目標を is_selected に設定
        if ($request->has('selected_goal_id')) {
            $goal = Goal::find($request->input('selected_goal_id'));
            if ($goal && $goal->user_id == $user->id) {
                $goal->is_selected = true;
                $goal->save();
                \Log::info('Updated selected goal:', ['goal_id' => $goal->id]);
            } else {
                \Log::warning('Goal not found or user mismatch.', ['goal_id' => $request->input('selected_goal_id')]);
            }
        } else {
            \Log::warning('No goal selected.');
        }

        return redirect()->route('goals.index')->with('status', '選択が保存されました');
    }
}