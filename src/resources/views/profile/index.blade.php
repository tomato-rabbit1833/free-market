<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">プロフィール</h1>

        {{-- 購入履歴 --}}
        <h2 class="text-xl font-semibold mb-2">購入履歴</h2>
        @if($purchasedItems->isEmpty())
            <p class="text-gray-600 mb-6">購入履歴はありません。</p>
        @else
            <ul class="mb-6 space-y-2">
                @foreach($purchasedItems as $purchase)
                    <li class="border p-4 rounded">
                        <p class="font-semibold">{{ $purchase->item->name ?? '商品なし' }}</p>
                        <p>購入日: {{ $purchase->purchased_at ? $purchase->purchased_at->format('Y年m月d日') : '未設定' }}</p>
                        <p>数量: {{ $purchase->quantity }}</p>
                        <p>支払い方法: {{ $purchase->payment_method === 'card' ? 'カード' : 'コンビニ' }}</p>
                        <p>配送先: {{ $purchase->shipping_address }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        {{-- 出品履歴 --}}
        <h2 class="text-xl font-semibold mb-2">出品履歴</h2>
        @if($listedItems->isEmpty())
            <p class="text-gray-600">出品履歴はありません。</p>
        @else
            <ul class="space-y-2">
                @foreach($listedItems as $item)
                    <li class="border p-4 rounded">
                        <p class="font-semibold">{{ $item->name }}</p>
                        <p>価格: ¥{{ number_format($item->price) }}</p>
                        <p>状態: {{ $item->condition }}</p>
                        <a href="{{ route('items.show', ['id' => $item->id]) }}" class="text-blue-500 underline">商品ページを見る</a>
                    </li>
                @endforeach
            </ul>
        @endif
    {{-- マイリストリンクだけを中央揃えに --}}
<div class="text-center mt-6">
    <a href="{{ route('wishlist.index') }}" class="text-pink-600 underline">♥ マイリストを見る</a>
</div>

{{-- いいねした商品一覧 --}}
<h2 class="text-xl font-semibold mb-2 mt-8">いいねした商品</h2>
@if($likedItems->isEmpty())
    <p class="text-gray-600">いいねした商品はありません。</p>
@else
    <ul class="space-y-2">
        @foreach($likedItems as $item)
            <li class="border p-4 rounded">
                <p class="font-semibold">{{ $item->name }}</p>
                <p>価格: ¥{{ number_format($item->price) }}</p>
                <p>状態: {{ $item->condition }}</p>
                <a href="{{ route('items.show', ['id' => $item->id]) }}" class="text-blue-500 underline">商品ページを見る</a>
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
