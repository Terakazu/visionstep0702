@extends('layouts.app')

@section('title', '質問一覧')

@section('content')
<div class="flex h-screen">
    
    <div class="flex flex-col w-full">
        <div class="container mx-auto p-4 flex-1">
            <h1 class="text-2xl font-bold mb-4">カテゴリ: {{ $category->name }} の質問一覧</h1>
            @if ($questions->isEmpty())
                <p>このカテゴリにはまだ質問がありません。</p>
            @else
                <ul class="space-y-4">
                    @foreach ($questions as $question)
                        <div class="bg-white p-4 rounded shadow">
                            <a href="{{ route('questions.show', $question->id) }}" class="text-indigo-600 hover:underline">
                                {{ $question->question_text }}
                            </a>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="text-center my-4">
            <a href="{{ route('categories.select') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                戻る
            </a>
        </div>
    </div>
</div>
@endsection
