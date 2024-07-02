@extends('layouts.app')

@section('title', '質問一覧')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">カテゴリ: {{ $category->name }} の質問一覧</h1>
        @if ($questions->isEmpty())
            <p>このカテゴリにはまだ質問がありません。</p>
        @else
            <ul class="space-y-4">
                @foreach ($questions as $question)
                    <li class="bg-white p-4 rounded shadow">
                        <a href="{{ route('questions.show', $question->id) }}" class="text-indigo-600 hover:underline">
                            {{ $question->question_text }}
                        </a>
                        <p class="text-gray-500 text-sm">投稿日: {{ $question->created_at->format('Y-m-d H:i') }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

