{{-- 住所変更フォーム --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>配送先住所変更</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">配送先住所変更</h1>

        <form method="POST" action="{{ route('purchase.updateAddress', ['id' => $item['id']]) }}">
            @csrf
            <label class="block mb-2 font-semibold">新しい住所:</label>
            <input type="text" name="shipping_address" class="w-full border p-2 rounded mb-4" value="{{ old('shipping_address', session('shipping_address', '東京都新宿区1-1-1')) }}">

            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                更新する
            </button>
        </form>
    </div>
</body>
</html>