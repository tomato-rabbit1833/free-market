<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>購入完了</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow text-center">
        <h1 class="text-2xl font-bold mb-4">購入が完了しました</h1>

        @if (session('message'))
            <p class="text-gray-700 mb-6">{{ session('message') }}</p>
        @else
            <p class="text-gray-700 mb-6">ご購入ありがとうございます！</p>
        @endif

        <a href="{{ route('items.index') }}" class="text-blue-500 underline">商品一覧に戻る</a>
    </div>
</body>
</html>
