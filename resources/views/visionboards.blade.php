@extends('layouts.app')
@section('content')
    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <form action="{{ route('home') }}" method="GET" class="w-full max-w-lg">
                <x-button class="bg-gray-100 text-gray-900">{{ __('Dashboard') }}</x-button>
            </form>
        </h2>
    </x-slot>
    <!--ヘッダー[END]-->

    <!-- バリデーションエラーの表示に使用-->
    <x-errors id="errors" class="bg-blue-500 rounded-lg">{{ $errors }}</x-errors>
    <!-- バリデーションエラーの表示に使用-->

    <!--全エリア[START]-->
    <div class="flex flex-wrap bg-gray-100">

       <!--左エリア[START]-->
    <div class="w-full md:w-1/3 p-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-500 font-bold">
            ビジョンボードを作成する
             </div>
        </div>

    <!-- ボードの登録フォーム -->
    <form action="{{ url('visionboards') }}" method="POST" class="w-full max-w-lg">
        @csrf
        <div class="flex flex-col px-2 py-2">
            <!-- カラム１ -->
            <div class="w-full px-3 mb-2">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    ボードの名前
                </label>
                <input name="board_name" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
            </div>

            <!-- 登録ボタン -->
            <div class="text-center px-4 py-2 m-2">
                <x-button class="bg-blue-500 rounded-lg">新規登録</x-button>
            </div>
        </div>
    </form>

            <!-- 現在のビジョンボードリスト -->
     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-500 font-bold">
            ビジョンボードを管理する
        </div>
    </div>
    <div>
        @if (count($visionboards) > 0)
            <ul>
                @foreach ($visionboards as $visionboard)
                    <li class="mb-2 flex justify-between items-center">
                        <div id="{{ $visionboard->id }}">
                            {{ $visionboard->board_name }}
                        </div>
                        <div>
                      
                          <a href="{{ route('visionboards.elements.index', ['visionboard' => $visionboard->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                要素を見る
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
    </div>
       <!-- ページネーション -->
    <div>
        {{ $visionboards->links() }}
    </div>
</div>
<!--左エリア[END]-->



      <!-- 右側エリア -->
<!-- 右側エリア -->
<div id="right-area" class="w-full md:w-2/3 p-2">
    <!-- 初期表示（最新のビジョンボード） -->
    @if ($latestVisionboard)
        <div class="visionboard">
            @foreach ($latestVisionboard->elements as $element)
                <div class="element" style="left: {{ $element->position_x }}px; bottom: {{ $element->position_y }}px;">
                    <p>{{ $element->element_data }}</p>
                    @if ($element->image)
                        <img src="/images/{{ $element->image }}" alt="Element Image" style="max-width: 100px;">
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p>ビジョンボードが見つかりません。</p>
    @endif
</div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 全ての「ボードを見る」ボタンを取得
        const viewButtons = document.querySelectorAll('.view-board');

        // ボタンにクリックイベントリスナーを追加
        viewButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // デフォルトのリンク動作を無効化
                const boardId = this.dataset.visionboardId;
                fetchBoardDetails(boardId);
            });
        });
    });

    function fetchBoardDetails(boardId) {
        fetch(`/api/visionboards/${boardId}`)
            .then(response => response.json())
            .then(data => {
                // 右側のエリアにビジョンボードの詳細を表示
                const rightArea = document.getElementById('right-area');
                rightArea.innerHTML = generateBoardHtml(data);
            })
            .catch(error => {
                console.error('Error fetching visionboard details:', error);
            });
    }

    function generateBoardHtml(data) {
        let html = `<div class="visionboard" style="position: relative; width: 800px; height: 600px; border: 1px solid #ccc; background-color: #f9f9f9; margin: 0 auto;">`;
        data.elements.forEach(element => {
            html += `<div class="element" style="position: absolute; left: ${element.position_x}px; bottom: ${element.position_y}px; border: 1px solid #000; padding: 10px; background-color: #fff;">`;
            html += `<p>${element.element_data}</p>`;
            if (element.image) {
                html += `<img src="/images/${element.image}" alt="Element Image" style="max-width: 100px;">`;
            }
            html += `</div>`;
        });
        html += `</div>`;
        return html;
    }
</script>
