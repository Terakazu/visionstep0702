
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@extends('layouts.app')

@section('content')
<div class="flex h-screen font-roboto bg-gradient-to-r from-pink-200 to-pink-100">
    <div class="flex-1 flex flex-col p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-2xl font-semibold mb-4">目標設定</h2>
            @if($latestGoal)
                <p class="mb-2">期限： {{ $latestGoal->deadline }}</p>
                <p class="mb-2">状態： {{ $latestGoal->condition }}</p>
                <p class="mb-2">アクション： {{ $latestGoal->action }}</p>
            @else
                <p>目標が設定されていません。</p>
            @endif
        </div>
        
       <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
    <h2 class="text-2xl font-semibold mb-4">ビジョンボード</h2>
    @if($latestVisionboard)
        <div class="flex flex-wrap -mx-2">
            <div class="mb-4 w-full px-2">
                <div class="bg-white p-4 rounded-lg shadow-lg h-full">
                    <h3 class="text-xl font-bold mb-2">{{ $latestVisionboard->title }}</h3>
                    <div class="visionboard relative w-[800px] h-[600px] border border-gray-300 bg-gray-100 mx-auto mb-4">
                        @foreach ($latestVisionboard->elements as $element)
                            <div class="element draggable"
                               data-id="{{ $element->id }}"
                               style="left: {{ $element->position_x }}px; top: {{ $element->position_y }}px; position: absolute;"
                               data-x="{{ $element->position_x }}" data-y="{{ $element->position_y }}">
                                <p class="{{ $element->text_style }} {{ $element->text_size }}">{{ $element->element_data }}</p>
                                @if ($element->image)
                                    <img src="{{ asset('images/' . $element->image) }}" alt="Element Image" style="max-width: 200px;">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>ビジョンボードがありません。</p>
    @endif
</div>
</div>
</div>
@endsection
