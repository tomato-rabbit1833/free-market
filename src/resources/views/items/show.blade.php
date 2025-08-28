@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

        {{-- 商品画像 --}}
        @if (!empty($item['image']))
            {{-- ダミーデータ用 --}}
            <img src="{{ asset('storage/items/' . $item['image']) }}" 
                 alt="{{ $item['name'] }}" 
                 class="w-full h-64 object-cover mb-4">
        @elseif (!empty($item->image_path))
            {{-- DB商品用 --}}
            <img src="{{ asset('storage/' . $item->image_path) }}" 
                 alt="{{ $item->name }}" 
                 class="w-full h-64 object-cover mb-4">
        @else
            <p class="text-gray-500">画像なし</p>
        @endif

        {{-- 商品名 --}}
        <h1 class="text-2xl font-bold mb-2">{{ $item->name ?? $item['name'] }}</h1>

        {{-- 価格 --}}
        <p class="text-xl text-red-600 mb-2">¥{{ number_format($item->price ?? $item['price']) }}</p>

        {{-- 商品の状態 --}}
        <p class="mb-2">コンディション: {{ $item->condition ?? $item['condition'] ?? '不明' }}</p>

        {{-- カテゴリ --}}
        @if (!empty($item->categories) && $item->categories->count() > 0)
            <p class="mb-4">
                カテゴリ: 
                @foreach ($item->categories as $category)
                    <span class="px-2 py-1 bg-gray-200 rounded">{{ $category->name }}</span>
                @endforeach
            </p>
        @endif

        {{-- 商品説明 --}}
        <p class="mb-6">{{ $item->description ?? $item['description'] }}</p>

        {{-- マイリストボタン --}}
        @auth
            <div class="mt-4 text-center">
                @if(Auth::user()->wishlistedItems && Auth::user()->wishlistedItems->contains($item->id))
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
                @if(Auth::user()->likedItems && Auth::user()->likedItems->contains($item->id))
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
                    <textarea name="content" rows="3" 
                              class="w-full border p-2 rounded mb-2" 
                              placeholder="コメントを入力してください" 
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        投稿する
                    </button>
                </form>
            </div>
        @endauth

        {{-- コメント一覧 --}}
        <div class="mt-8 border-t pt-6">
            <h2 class="text-xl font-semibold mb-2">コメント一覧</h2>

            @if (!empty($item->comments) && $item->comments->count() > 0)
                @foreach($item->comments as $comment)
                    <div class="border-b py-2">
                        <p class="text-gray-800 font-semibold">{{ $comment->user->name ?? 'ゲスト' }}</p>
                        <p class="text-gray-600 text-sm">{{ $comment->created_at->format('Y年m月d日 H:i') }}</p>
                        <p class="text-gray-700 mt-1">{{ $comment->content }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-gray-600">まだコメントはありません。</p>
            @endif
        </div>

        {{-- 戻るリンク --}}
        <a href="{{ route('items.index') }}" class="inline-block mt-4 text-blue-500 underline">← 一覧へ戻る</a>
    </div>
</div>
@endsection
