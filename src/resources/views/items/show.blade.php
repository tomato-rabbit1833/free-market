{{-- 商品詳細 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $item->name }}の詳細</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">{{ $item->name }}</h1>

        {{-- 画像 --}}
        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-64 object-cover mb-4">

        <p class="text-gray-700 mb-2">価格: ¥{{ number_format($item->price) }}</p>
        <p class="text-gray-700 mb-2">説明: {{ $item->description }}</p>
        <p class="text-gray-500">コンディション: {{ $item->condition }}</p>

        {{-- マイリストボタン --}}
        @auth
            <div class="mt-4 text-center">
                @if(Auth::user()->wishlistedItems->contains($item->id))
                    <form method="POST" action="{{ route('wishlist.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 underline">♥ マイリストから削除</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('wishlist.store', $item->id) }}">
                        @csrf
                        <button class="text-blue-500 underline">♡ マイリストに追加</button>
                    </form>
                @endif
            </div>
        @endauth

        {{-- いいねボタン --}}
        @auth
            <div class="mt-4 text-center">
                @if(Auth::user()->likedItems->contains($item->id))
                    <form method="POST" action="{{ route('like.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 underline">♥ いいね済み（取り消す）</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('like.store', $item->id) }}">
                        @csrf
                        <button class="text-blue-500 underline">♡ いいねする</button>
                    </form>
                @endif
            </div>
        @endauth

        {{-- コメント投稿 --}}
        @auth
            <div class="mt-8 border-t pt-6">
                <h2 class="text-xl font-semibold mb-2">コメントを投稿する</h2>

                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('comment.store', ['id' => $item->id]) }}">
                    @csrf
                    <textarea name="content" rows="3" class="w-full border p-2 rounded mb-2" placeholder="コメントを入力してください">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">投稿する</button>
                </form>
            </div>
        @endauth

        {{-- コメント一覧 --}}
        <div class="mt-8 border-t pt-6">
            <h2 class="text-xl font-semibold mb-2">コメント一覧</h2>

            @forelse($item->comments as $comment)
                <div class="border-b py-2">
                    <p class="text-gray-800 font-semibold">{{ $comment->user->name ?? 'ゲスト' }}</p>
                    <p class="text-gray-600 text-sm">{{ $comment->created_at->format('Y年m月d日 H:i') }}</p>
                    <p class="text-gray-700 mt-1">{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-gray-600">まだコメントはありません。</p>
            @endforelse
        </div>

        <a href="{{ route('items.index') }}" class="inline-block mt-4 text-blue-500 underline">← 一覧へ戻る</a>
    </div>
</body>
</html>
