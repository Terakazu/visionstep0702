<!DOCTYPE html>
<html>
<head>
    <title>チャット</title>
</head>
<body>
    <h1>チャット</h1>
    <form action="{{ route('chat') }}" method="POST">
        @csrf
        <label for="goodpoint">良いことを入力してください:</label>
        <input type="text" id="goodpoint" name="goodpoint">
        <button type="submit">送信</button>
    </form>

    @if(isset($messages) && count($messages) > 0)
        <div>
            @foreach ($messages as $message)
                <h2>{{ $message['title'] }}</h2>
                <p>{{ $message['content'] }}</p>
            @endforeach
        </div>
    @endif
</body>
</html>
