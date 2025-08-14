{{-- 商品一覧 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">商品一覧</h1>

        {{-- 検索フォーム --}}
      <form action="{{ route('items.index') }}" method="GET" class="mb-4">
    <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
        {{-- 商品名 --}}
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索" class="border rounded px-4 py-2 w-full md:w-1/4">

        {{-- カテゴリ --}}
        <select name="category_id" class="border rounded px-4 py-2 w-full md:w-1/4">
            <option value="">カテゴリ選択</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- 最小価格 --}}
        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="最小価格" class="border rounded px-4 py-2 w-full md:w-1/6">

        {{-- 最大価格 --}}
        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="最大価格" class="border rounded px-4 py-2 w-full md:w-1/6">

        {{-- 検索ボタン --}}
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            検索
        </button>
    </div>

    <label for="sort">並び替え:</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="">選択してください</option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が安い順</option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>新着順</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>古い順</option>
    </select>

    
   
</form>


        {{-- 商品一覧 or メッセージ --}}
        @if ($items->isEmpty())
            <p class="text-gray-600">該当する商品は見つかりませんでした。</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($items as $item)
                    <div class="border rounded p-4 shadow hover:shadow-md transition">
                        {{-- 画像の表示 --}}
@if ($item->image)
    <img src="{{ asset('storage/items/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-auto">
@else
    <p class="text-sm text-gray-500">画像なし</p>
@endif

                        <h2 class="text-xl font-semibold">{{ $item['name'] }}</h2>
                        <p class="text-gray-700">¥{{ number_format($item['price']) }}</p>
                        <p class="text-sm text-gray-600 mb-1">{{ $item['description'] }}</p>
                        <p class="text-sm text-gray-500">コンディション: {{ $item['condition'] }}</p>

                        {{-- 詳細ページへのリンク --}}
                        <a href="{{ route('items.show', $item['id']) }}" class="text-blue-500 underline text-sm mt-2 inline-block">詳細を見る</a>
                    </div>
                @endforeach
            {{-- ページネーションリンク --}}
<div class="mt-6">
    {{ $items->links() }}
</div>
        @endif
    </div>
</body>
</html>
