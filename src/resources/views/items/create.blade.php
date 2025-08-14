@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">商品を出品する</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow-md">
        @csrf

        <div>
            <label for="name" class="block font-semibold">商品名</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded p-2" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block font-semibold">商品説明</label>
            <textarea name="description" id="description" class="w-full border-gray-300 rounded p-2" rows="4" required>{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="price" class="block font-semibold">価格</label>
            <input type="number" name="price" id="price" class="w-full border-gray-300 rounded p-2" value="{{ old('price') }}" required>
            @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="image" class="block font-semibold">商品画像</label>
            <input type="file" name="image" id="image" class="w-full border-gray-300 rounded p-2">
            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">出品する</button>
        </div>
    </form>
</div>
@endsection
