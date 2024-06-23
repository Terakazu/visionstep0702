@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ビジョンボード詳細</h1>

    <!-- ビジョンボードの詳細を表示 -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $visionboard->board_name }}</h2>
            <!-- 他のビジョンボードに関する情報 -->
        </div>
    </div>

    <!-- 新しい要素を作成するリンク -->
    <a href="{{ route('visionboards.elements.create', ['visionboard' => $visionboard->id]) }}" class="btn btn-primary mt-3">新しい要素を作成</a>

    <!-- 要素一覧ページへのリンク -->
    <a href="{{ route('elements.index', ['visionboard' => $visionboard->id]) }}" class="btn btn-secondary mt-3">要素を見る</a>
</div>
@endsection