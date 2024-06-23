<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- ヘッダー -->
    <div class="mb-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マイページ
        </h2>
    </div>

    <!-- コンテンツエリア -->
    <div class="flex flex-wrap bg-gray-100">
        <!-- 左エリア -->
        <div class="w-full md:w-1/3 p-2">
            <!-- ビジョンボードの作成 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    ビジョンボードを作成する
                </div>
                <form action="{{ url('visionboards') }}" method="POST" class="w-full max-w-lg">
                    @csrf
                    <div class="flex flex-col px-2 py-2">
                        <div class="w-full px-3 mb-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                ボードの名前
                            </label>
                            <input name="board_name" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                        </div>
                        <div class="text-center px-4 py-2 m-2">
                            <x-button class="bg-blue-500 rounded-lg">新規登録</x-button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ビジョンボードの管理 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    ビジョンボードを管理する
                </div>
                @if (!empty($visionboards) && count($visionboards) > 0)
                    <ul>
                        @foreach ($visionboards as $visionboard)
                            <li class="mb-2 flex justify-between items-center">
                                <div id="{{ $visionboard->id }}">
                                    {{ $visionboard->board_name }}
                                    
                                </div>
                                <div>
                                 <a href="{{ route('visionboards.show', ['visionboard' => $visionboard->id]) }}" class="view-board bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
    ボードを見る
</a>
                                     <a href="{{ route('visionboards.elements.create', ['visionboard' => $visionboard->id]) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                        要素を登録
                                    </a>
                                    <a href="{{ route('visionboard_edit', ['visionboard' => $visionboard->id]) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                        更新
                                    </a>
                                    <form action="{{ route('visionboard_destroy', ['visionboard' => $visionboard->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No visionboards found.</p>
                @endif
                <!-- ページネーション -->
                <div>
                    {{ $visionboards->links() }}
                </div>
            </div>
        </div>

        <!-- 右エリア -->
        <div class="w-full md:w-2/3 p-2">
            <div id="right-area">
                @if ($latestVisionboard)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-500 font-bold">
                            選択中のビジョンボード: {{ $latestVisionboard->board_name }}
                        </div>
                        <div class="visionboard" style="position: relative; width: 800px; height: 600px; border: 1px solid #ccc; background-color: #f9f9f9; margin: 0 auto;">
                            @foreach ($latestVisionboard->elements as $element)
                                <div class="element" style="position: absolute; left: {{ $element->position_x }}px; bottom: {{ $element->position_y }}px; border: 1px solid #000; padding: 10px; background-color: #fff;">
                                    <p>{{ $element->element_data }}</p>
                                    @if ($element->image)
                                        <img src="/images/{{ $element->image }}" alt="Element Image" style="max-width: 100px;">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p>ビジョンボードが見つかりません。</p>
                @endif
            </div>
        </div>
    </div>
@endsection

 