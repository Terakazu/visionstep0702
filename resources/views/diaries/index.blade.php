<!-- resources/views/diaries/index.blade.php -->

@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('日記一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('diaries.create') }}" class="btn btn-success">新しい日記を作成</a>
                    </div>
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">日付</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">画像</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">本文</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">よかったこと</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">更新日時</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diaries as $diary)
                                <tr>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $diary->calendar_date }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $diary->image ? '<img src="'.$diary->image.'" alt="Image" class="w-16 h-16">' : 'No Image' }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $diary->body }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $diary->goodpoint }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $diary->updated_at }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        <a href="{{ route('diaries.edit', $diary->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('diaries.destroy', $diary->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($diaries->isEmpty())
                        <p class="mt-4 text-gray-600 dark:text-gray-400">日記がありません。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
