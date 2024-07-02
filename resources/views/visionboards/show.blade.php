@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
        <div class="p-6 bg-white border-b border-gray-500 font-bold">
            選択中のビジョンボード: {{ $visionboard->board_name }}
            <a href="{{ route('visionboards.elements.create', ['visionboard' => $visionboard->id]) }}" class="view-board bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">新しい要素を作成</a>
            <a href="{{ route('visionboards.elements.index', ['visionboard' => $visionboard->id]) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">一覧を表示</a>
        </div>
    </div>
    
    
    <div class="visionboard relative w-[800px] h-[600px] border border-gray-300 bg-gray-100 mx-auto mb-4">
        @foreach ($visionboard->elements as $element)
            <div class="element draggable" 
               data-id="{{ $element->id }}" 
               style="left: {{ $element->position_x }}px; top: {{ $element->position_y }}px;" 
               data-x="{{ $element->position_x }}" data-y="{{ $element->position_y }}">
                <p>{{ $element->element_data }}</p>
                @if ($element->image)
                    <img src="{{ asset('images/' . $element->image) }}" alt="Element Image" style="max-width: 200px;">
                @endif
            </div>
        @endforeach
    </div>
    <div class="text-center">
        <button id="save-button" class="bg-blue-500 rounded-lg">位置を保存</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.17/interact.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let offsetX = 0;
            let offsetY = 0;

            interact('.draggable')
                .draggable({
                    inertia: true,
                    modifiers: [
                        interact.modifiers.restrictRect({
                            restriction: 'parent',
                            endOnly: true
                        })
                    ],
                    autoScroll: true,
                    listeners: {
                        start(event) {
                            let rect = event.target.getBoundingClientRect();
                            offsetX = event.clientX - rect.left;
                            offsetY = event.clientY - rect.top;
                        },
                        move(event) {
                            let target = event.target;

                            let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                            let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                            target.style.left = `${x}px`;
                            target.style.top = `${y}px`;

                            target.setAttribute('data-x', x);
                            target.setAttribute('data-y', y);
                        }
                    }
                });

            document.querySelectorAll('.draggable').forEach(element => {
                let x = parseFloat(element.getAttribute('data-x')) || 0;
                let y = parseFloat(element.getAttribute('data-y')) || 0;

                element.style.left = `${x}px`;
                element.style.top = `${y}px`;
                element.style.position = 'absolute';
            });

            document.getElementById('save-button').addEventListener('click', function() {
                const elements = document.querySelectorAll('.draggable');
                const positions = [];
                elements.forEach(function(element) {
                    let id = element.getAttribute('data-id');
                    let x = parseFloat(element.getAttribute('data-x')) || 0;
                    let y = parseFloat(element.getAttribute('data-y')) || 0;

                    positions.push({
                        id: id,
                        position_x: x,
                        position_y: y
                    });
                });

                fetch('{{ route("visionboards.elements.savePositions", ["visionboard" => $visionboard->id]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ positions: positions })
            })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Unknown error');
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        alert('位置が保存されました！');
                    } else {
                        alert('保存に失敗しました。');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('エラーが発生しました: ' + error.message);
                });
            });
        });
    </script>
@endsection
