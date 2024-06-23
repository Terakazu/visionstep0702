<!-- resources/views/elements/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ビジョンボードの要素一覧</h1>
    
    <a href="{{ route('visionboards.elements.create', ['visionboard' => $visionboard->id]) }}" class="btn btn-primary">新しい要素を作成</a>
    <a href="{{ route('visionboards.show', ['visionboard' => $visionboard->id]) }}"  class="btn btn-primary">並べてみる</a>
    
    @if ($elements->isEmpty())
        <p>要素がありません。</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>タイプ</th>
                    <th>データ</th>
                    <th>画像</th>
                    <th>位置X</th>
                    <th>位置Y</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elements as $element)
                    <tr>
                        <td>{{ $element->element_type }}</td>
                        <td>{{ $element->element_data }}</td>
                        <td>
                            @if ($element->image)
                                <img src="{{ asset('images/' . $element->image) }}" alt="Element Image" style="max-width: 100px;">
                            @endif
                        </td>
                        <td>{{ $element->position_x }}</td>
                        <td>{{ $element->position_y }}</td>
                        <td>
                           <a href="{{ route('visionboards.elements.edit', ['visionboard' => $visionboard->id, 'element' => $element->id]) }}">編集</a>
                            <form action="{{ route('visionboards.elements.destroy',['visionboard' => $visionboard->id, 'element' => $element->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
    