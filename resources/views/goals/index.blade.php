@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('目標設定') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('goals.create') }}" class="btn btn-success">新しい目標を作成</a>
                    </div>
                    @if($goals->isEmpty())
                        <p>現在、目標はありません。</p>
                    @else
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">期限</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">状態</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">アクション</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-left leading-4 text-gray-800 dark:text-gray-200">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($goals as $goal)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $goal->deadline }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $goal->condition }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">{{ $goal->action }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
