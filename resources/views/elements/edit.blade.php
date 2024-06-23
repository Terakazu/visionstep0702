@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Element') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('visionboards.elements.update', ['visionboard' => $visionboard->id, 'element' => $element->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col px-2 py-2">
                            <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    要素のタイプ
                                </label>
                                <input name="element_type" value="{{ $element->element_type }}" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                            </div>
                            <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    要素のデータ
                                </label>
                                <input name="element_data" value="{{ $element->element_data }}" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                            </div>
                            <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    写真
                                </label>
                                <input name="image" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="file" placeholder="">
                            </div>
                            <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    x座標
                                </label>
                                <input name="position_x" value="{{ $element->position_x }}" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" placeholder="">
                            </div>
                            <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    y座標
                                </label>
                                <input name="position_y" value="{{ $element->position_y }}" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" placeholder="">
                            </div>
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
    </div>
@endsection
