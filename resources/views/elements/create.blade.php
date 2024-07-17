@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           要素を登録 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
               <form action="{{ route('visionboards.elements.store', ['visionboard' => $visionboard->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                     @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="flex flex-col px-2 py-2">
                        <!-- カラム１ -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                要素のタイプ（テキストまたは画像）
                            </label>
                            <select name="element_type" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                <option value="text" {{ old('element_type') == 'text' ? 'selected' : '' }}>テキスト</option>
                                <option value="image" {{ old('element_type') == 'image' ? 'selected' : '' }}>画像</option>
                            </select>
                        </div>
                        <!-- カラム２ -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                テキスト（画像の場合は、画像キャプション）
                            </label>
                            <input name="element_data" value="{{ old('element_data') }}" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                        </div>
                        <!-- カラム３ -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    画像
                                </label>
                                <input name="image" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="file" placeholder="">
                         </div>
                         
                          <!-- テキストスタイルオプション -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                文字のスタイル
                            </label>
                            <select name="text_style" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                <option value="normal">標準</option>
                                <option value="bold">太字</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                文字のサイズ
                            </label>
                            <select name="text_size" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                <option value="text-base">標準</option>
                                <option value="text-2xl">大</option>
                                <option value="text-4xl">特大</option>
                            </select>
                        </div>
                       
                         <input type="hidden" name="visionboard_id" value="{{ $visionboard->id }}">
                        <!-- 保存ボタン -->
                        <div class="flex flex-col">
                            <div class="text-gray-700 text-center px-4 py-2 m-2">
                                <x-button class="bg-blue-500 rounded-lg">保存</x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


