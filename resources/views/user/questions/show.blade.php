@extends('layouts.app')

@section('title', '質問詳細')

@section('content')
<div class="flex h-screen">
 <aside class="w-[300px] p-6 bg-gradient-to-t from-pink-300 to-pink-200 text-white rounded-lg shadow-lg flex flex-col">
      <div class="text-center text-black mb-6 text-2xl font-bold">
            <img src="{{ asset('images/logo.png') }}" alt="VisionStep Logo" class="mx-auto mb-4" style="max-width: 150px;">
        </div>

         <ul class="flex-1">
            <x-sidebar-item icon="fa-home" text="TOP" link="{{ route('home') }}" />
            <x-sidebar-item icon="fa-heart" text="価値観の発掘" link="{{ route('categories.select') }}" />
            <x-sidebar-item icon="fa-tasks" text="ビジョンボード" link="{{ route('visionboards.index') }}" />
            <x-sidebar-item icon="fa-calendar-alt" text="日記" link="{{ route('diaries.index') }}" />
            <x-sidebar-item icon="fa-cogs" text="目標設定" link="{{ route('goals.index') }}" />
        </ul>
    </aside>
    
    <div class="container mx-auto p-4">
        <header class="mb-4">
            <h1 class="text-2xl font-bold">質問詳細</h1>
        </header>

        <div class="bg-white p-4 rounded shadow-md mb-6">
            <p class="text-gray-800">{{ $question->question_text }}</p>
            <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">{{ $question->category->name }}</span>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">回答する</h2>
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('answers.store', $question->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="answer_text" class="block text-sm font-medium text-gray-700">回答</label>
                    <input type="text" name="answer_text" id="answer_text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">送信</button>
                </div>
            </form>
        </div>

       <div>
            <h2 class="text-xl font-semibold mb-4">以前の回答</h2>
            @if ($userAnswers->isEmpty())
                <p>まだ回答はありません。</p>
            @else
                <ul class="space-y-4">
                    @foreach ($userAnswers as $answer)
                        <li class="bg-white p-4 rounded shadow-sm">
                            <p>{{ $answer->answer_text }}</p>
                            <span class="text-gray-500 text-xs">{{ $answer->created_at->format('Y-m-d H:i') }}</span>
                        </li>
                    @endforeach
                @endif
                </ul>
        </div>
    </div>
</div>
@endsection