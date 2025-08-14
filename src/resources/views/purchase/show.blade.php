{{-- resources/views/purchase/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">購入確認</h1>

    <div class="bg-white shadow-md rounded p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">商品情報</h2>
        <p><strong>商品名:</strong> {{ $item->name }}</p>
        <p><strong>価格:</strong> ¥{{ number_format($item->price) }}</p>
        <p><strong>説明:</strong> {{ $item->description }}</p>
    </div>

    <form action="{{ route('purchase.store', ['id' => $item->id]) }}" method="POST" class="bg-white shadow-md rounded p-6">
        @csrf
        <div class="mb-4">
            <label for="payment_method" class="block text-gray-700 font-medium mb-2">支払い方法</label>
            <select name="payment_method" id="payment_method" class="border border-gray-300 rounded px-4 py-2 w-full">
                <option value="credit_card">クレジットカード</option>
                <option value="bank_transfer">銀行振込</option>
                <option value="cash_on_delivery">代金引換</option>
            </select>
        </div>

        <div class="mb-6">
            <label for="address" class="block text-gray-700 font-medium mb-2">配送先住所</label>
            <input type="text" name="address" id="address" value="{{ old('address', Auth::user()->address ?? '') }}" class="border border-gray-300 rounded px-4 py-2 w-full" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">購入する</button>
    </form>
</div>
@endsection
