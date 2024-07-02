@extends('layouts.app')

@section('title', 'カテゴリー選択')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">テーマを選択してください</h1>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($categories as $category)
                <div class="bg-gray-200 p-4 rounded shadow cursor-pointer text-center" onclick="location.href='{{ route('questions.byCategory', $category->id) }}'">
                    <p>{{ $category->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection