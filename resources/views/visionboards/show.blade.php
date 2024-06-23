@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-500 font-bold">
            選択中のビジョンボード: {{ $visionboard->board_name }}
            <a href="{{ route('visionboards.elements.create', ['visionboard' => $visionboard->id]) }}" class="btn btn-primary">新しい要素を作成</a>
            <a href="{{ route('visionboards.elements.index', ['visionboard' => $visionboard->id]) }}" class="btn btn-primary">一覧を表示</a>
        </div>
    </div>
    <div class="visionboard" style="position: relative; width: 800px; height: 600px; border: 1px solid #ccc; background-color: #f9f9f9; margin: 0 auto;">
        <!-- 要素をループして表示 -->
        @foreach ($visionboard->elements as $element)
            <div class="element" style="position: absolute; left: {{ $element->position_x }}px; bottom: {{ $element->position_y }}px; padding: 10px; background-color: #fff;">
                <p>{{ $element->element_data }}</p>
                @if ($element->image)
                    <img src="/images/{{ $element->image }}" alt="Element Image" style="max-width: 200px;">
                @endif
            </div>
        @endforeach
    </div>
@endsection
