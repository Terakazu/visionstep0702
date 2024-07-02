@extends('layouts.app')

@section('title', '質問一覧')

@section('content')
    <div class="container">
        <h1>質問一覧</h1>
        <ul>
            @foreach ($questions as $question)
                <li>
                    <a href="{{ route('questions.show', $question->id) }}">
                        {{ $question->question_text }} - カテゴリ: {{ $question->category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
