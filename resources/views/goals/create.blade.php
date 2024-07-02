@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('新しい目標を作成') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('goals.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300">期限</label>
                            <input type="date" name="deadline" id="deadline" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="condition" class="block text-sm font-medium text-gray-700 dark:text-gray-300">目指している状態</label>
                            <input type="text" name="condition" id="condition" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="action" class="block text-sm font-medium text-gray-700 dark:text-gray-300">アクション</label>
                            <textarea name="action" id="action" rows="3" class="mt-1 block w-full" required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">作成</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
