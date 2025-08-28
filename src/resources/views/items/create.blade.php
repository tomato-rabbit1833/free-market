@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">商品を出品する</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow-md">
        @csrf

        {{-- 商品名 --}}
        <div>
            <label for="name" class="block font-semibold">商品名</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded p-2"
                   value="{{ old('name') }}" required>
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品説明 --}}
        <div>
            <label for="description" class="block font-semibold">商品説明</label>
            <textarea name="description" id="description" class="w-full border-gray-300 rounded p-2" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 価格 --}}
        <div>
            <label for="price" class="block font-semibold">価格</label>
            <input type="number" name="price" id="price" class="w-full border-gray-300 rounded p-2"
                   value="{{ old('price') }}" required>
            @error('price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- カテゴリ（複数選択可能） --}}
        <div>
            <label for="category" class="block font-semibold">カテゴリ</label>
            <select name="category_id[]" id="category" class="w-full border-gray-300 rounded p-2" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ (collect(old('category_id'))->contains($category->id)) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            <p class="text-gray-500 text-sm mt-1">※ Ctrl / Cmd を押しながら複数選択できます</p>
        </div>

        {{-- 商品の状態 --}}
        <div>
            <label for="condition" class="block font-semibold">商品の状態</label>
            <select name="condition" id="condition" class="w-full border-gray-300 rounded p-2" required>
                <option value="">選択してください</option>
                <option value="新品" {{ old('condition') == '新品' ? 'selected' : '' }}>新品</option>
                <option value="未使用に近い" {{ old('condition') == '未使用に近い' ? 'selected' : '' }}>未使用に近い</option>
                <option value="良好" {{ old('condition') == '良好' ? 'selected' : '' }}>良好</option>
                <option value="やや傷や汚れあり" {{ old('condition') == 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                <option value="状態が悪い" {{ old('condition') == '状態が悪い' ? 'selected' : '' }}>状態が悪い</option>
            </select>
            @error('condition')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品画像 --}}
        <div>
            <label for="image" class="block font-semibold">商品画像</label>
            <input type="file" name="image" id="image" class="w-full border-gray-300 rounded p-2">
            @error('image')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 出品ボタン --}}
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                出品する
            </button>
        </div>
    </form>
</div>
@endsection
