@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between h-16">
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('カテゴリー一覧') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <h1>カテゴリ一覧</h1>
                    <ul>
                        @foreach ($categories as $category)
                        <li>
                            {{ $category ? $category->name : 'カテゴリーが見つかりませんでした' }}
                            <!-- 各カテゴリに質問を作成するボタンを追加 -->
                            <a href="{{ route('admin.questions.create', ['category' => $category->id]) }}" class="btn btn-primary">
                                質問作成
                            </a>
                            <!-- 各カテゴリに削除ボタンを追加 -->
                            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('本当にこのカテゴリーを削除しますか？');">削除</button>
                            </form>
                        </li>
                        @endforeach
                        <li>
                            <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary">
                                回答一覧
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
