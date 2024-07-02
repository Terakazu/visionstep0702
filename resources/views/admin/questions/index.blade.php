@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between h-16">
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('質問一覧') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>質問一覧</h1>
                    @foreach ($categories as $category)
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mt-6">{{ $category->name }}</h2>
                            <a href="{{ route('admin.questions.create', $category->id) }}" class="btn btn-success btn-sm">
                                新規作成
                            </a>
                        </div>
                        <ul class="list-disc pl-6">
                            @forelse ($category->questions as $question)
                                <li>
                                    <strong>質問:</strong> {{ $question->question_text }}<br>
                                    <small>作成日: {{ $question->created_at->format('Y-m-d') }}</small>
                                    <!-- 質問の詳細、編集、削除へのリンクを追加 -->
                                    <div class="mt-2">
                                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-primary btn-sm">
                                            編集
                                        </a>
                                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当にこの質問を削除しますか？');">削除</button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li>このカテゴリーには質問がありません。</li>
                            @endforelse
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
