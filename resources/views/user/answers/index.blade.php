@extends('layouts.app')

@section('title', 'あなたの回答')

@section('content')
<div class="flex h-screen">
 

    <div class="flex flex-col w-full">
        <div class="container mx-auto p-4 flex-1">
            <header class="mb-4">
                <h1 class="text-2xl font-bold">あなたの回答</h1>
            </header>

            @if ($userAnswers->isEmpty())
                <p>まだ回答はありません。</p>
            @else
                <ul class="space-y-4">
                    @foreach ($userAnswers as $answer)
                        <li class="bg-white p-4 rounded shadow-sm">
                            <h2 class="text-lg font-semibold">{{ $answer->question->question_text }}<span class="tag">{{ $answer->question->category->name }}</span></h2>
                            <p>{{ $answer->answer_text }}</p>
                            <span class="text-gray-500 text-xs">{{ $answer->created_at->format('Y-m-d H:i') }}</span>
                        </li>
                    @endforeach
                </ul>

                <!-- ページネーションリンク -->
                <div class="mt-4">
                    {{ $userAnswers->links() }}
                </div>
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
