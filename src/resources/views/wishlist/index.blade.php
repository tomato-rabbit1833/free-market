<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイリスト</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">♥ マイリスト</h1>

        @if($wishlistedItems->isEmpty())
            <p class="text-center text-gray-600">マイリストに商品はありません。</p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($wishlistedItems as $item)
                    <li class="border p-4 rounded bg-gray-50">

                        {{-- 商品画像 --}}
                        @if (!empty($item->image_path))
                            {{-- 出品商品（storage） --}}
                            <img src="{{ asset('storage/' . $item->image_path) }}" 
                                 alt="{{ $item->name }}" 
                                 class="w-full h-40 object-cover mb-2">
                        @elseif (!empty($item->image))
                            {{-- ダミーデータ（public/images） --}}
                            <img src="{{ asset('images/' . $item->image) }}" 
                                 alt="{{ $item->name }}" 
                                 class="w-full h-40 object-cover mb-2">
                        @else
                            <p class="text-sm text-gray-500">画像なし</p>
                        @endif

                        {{-- 商品名・価格 --}}
                        <h2 class="font-semibold text-lg">{{ $item->name }}</h2>
                        <p class="text-gray-700">¥{{ number_format($item->price) }}</p>

                        {{-- 詳細ページ --}}
                        <a href="{{ route('items.show', ['id' => $item->id]) }}" 
                           class="text-blue-500 underline block mt-2">
                            商品ページへ
                        </a>

                        {{-- マイリストから削除 --}}
                        <form method="POST" action="{{ route('wishlist.destroy', $item->id) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 underline">♥ マイリストから削除</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="text-center mt-6">
            <a href="{{ route('items.index') }}" class="text-blue-500 underline">← 商品一覧に戻る</a>
            <a href="{{ route('profile.index') }}" class="ml-4 text-blue-500 underline">プロフィールへ</a>
        </div>
    </div>
</body>
</html>
