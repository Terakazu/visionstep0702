@extends('layouts.app')

@section('title', '新しい日記を作成')

@section('content')
    <div class="container">
        <h1 class="text-center">新しい日記を作成</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('diaries.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="calendar_date" class="block font-medium text-sm text-gray-700 dark:text-gray-200">日付:</label>
                                <input type="date" id="calendar_date" name="calendar_date" class="form-control mt-1 block w-full" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="image" class="block font-medium text-sm text-gray-700 dark:text-gray-200">画像:</label>
                                <input type="file" id="image" name="image" class="form-control mt-1 block w-full">
                            </div>

                            <div class="form-group mb-4">
                                <label for="body" class="block font-medium text-sm text-gray-700 dark:text-gray-200">本文:</label>
                                <textarea id="body" name="body" class="form-control mt-1 block w-full" rows="4" required></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="goodpoint" class="block font-medium text-sm text-gray-700 dark:text-gray-200">よかったこと:</label>
                                <textarea id="goodpoint" name="goodpoint" class="form-control mt-1 block w-full" rows="2" required></textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
