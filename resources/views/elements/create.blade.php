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
                    <div class="flex flex-col px-2 py-2">
                        <!-- カラム１ -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                要素のタイプ
                            </label>
                            <input name="element_type" value="{{ old('element_type') }}" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                        </div>
                        <!-- カラム２ -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                要素のデータ
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
                        <!-- カラム４ -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                x座標
                            </label>
                            <input name="position_x" value="{{ old('position_x') }}" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" placeholder="">
                        </div>
                        <!-- カラム５ -->
                        <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                y座標
                            </label>
                            <input name="position_y" value="{{ old('position_y') }}" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" placeholder="">
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
