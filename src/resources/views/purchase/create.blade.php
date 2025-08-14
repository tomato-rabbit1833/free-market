<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>購入画面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> {{-- ← スマホ対応 --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 px-4 sm:px-6">
    <div class="max-w-xl mx-auto bg-white p-6 sm:p-8 rounded shadow">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center">購入手続き</h1>

        {{-- 商品情報 --}}
        <div class="mb-6">
            <p class="text-lg sm:text-xl">商品名: {{ $item['name'] }}</p>
            <p class="text-gray-700">価格: ¥{{ number_format($item['price']) }}</p>
        </div>

        {{-- 配送先住所 --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-1">配送先住所</h2>
            <p class="text-gray-700 text-sm sm:text-base">
                {{ Auth::user()->address ?? '住所が未登録です。プロフィールから登録してください。' }}
            </p>

            <p class="text-gray-700 text-sm sm:text-base mt-2">配送先住所: {{ session('shipping_address', '東京都新宿区1-1-1') }}</p>
            <a href="{{ route('purchase.editAddress', ['id' => $item['id']]) }}" class="inline-block mt-1 text-blue-500 underline text-sm sm:text-base">
                住所を変更する
            </a>
        </div>

       <form method="POST" action="{{ route('purchase.store', ['id' => $item['id']]) }}">
    @csrf

    {{-- 支払い方法 --}}
<div class="mb-4">
    <label for="payment_method" class="block font-medium text-sm sm:text-base mb-1">支払い方法</label>
    <select name="payment_method" id="payment_method" class="w-full border rounded p-2 text-sm sm:text-base">
        <option value="convenience">コンビニ支払い</option>
        <option value="card">カード支払い</option>
    </select>
</div>

{{-- 配送先住所 --}}
<div class="mb-4">
    <label for="shipping_address" class="block font-medium text-sm sm:text-base mb-1">配送先住所</label>
    <input type="text" name="shipping_address" id="shipping_address" value="{{ old('shipping_address') }}"
           class="w-full border rounded p-2 text-sm sm:text-base" placeholder="〇〇県〇〇市〇〇町〇丁目〇番地" required>
</div>

{{-- 購入ボタン --}}
<button type="submit" class="mt-4 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 text-sm sm:text-base">
    購入する
</button>
</form>

        {{-- 戻るリンク --}}
        <div class="mt-6 text-center">
            <a href="{{ route('items.show', ['id' => $item['id']]) }}" class="text-blue-500 text-sm sm:text-base">← 商品詳細に戻る</a>
        </div>
    </div>
</body>
</html>