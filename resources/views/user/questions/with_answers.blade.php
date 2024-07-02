@extends('layouts.app')

@section('title', '質問と回答の一覧')

@section('content')
    <div class="container">
        <h1>質問と回答の一覧</h1>
        @foreach ($questions as $question)
            <div class="mb-4">
                <h2>{{ $question->question_text }}</h2>
                <p>カテゴリ: {{ $question->category->name }}</p>

                <h3>回答一覧</h3>
                <ul>
                    @foreach ($question->answers as $answer)
                        <li>{{ $answer->answer_text }} ({{ $answer->created_at->format('Y-m-d H:i') }})</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
