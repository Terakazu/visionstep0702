<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;

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
}
