{{-- プロフィール表示 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">プロフィール</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- プロフィール画像 --}}
        @if ($user->profile_image)
            <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}" alt="プロフィール画像" class="w-32 h-32 object-cover rounded-full mx-auto mb-4">
        @else
            <p class="text-center text-gray-500 mb-4">プロフィール画像なし</p>
        @endif

        <p><strong>ユーザー名：</strong> {{ $user->name }}</p>
        <p><strong>郵便番号：</strong> {{ $user->zipcode ?? '未登録' }}</p>
        <p><strong>住所：</strong> {{ $user->address ?? '未登録' }}</p>

        <a href="{{ route('profile.edit') }}" class="inline-block mt-6 text-blue-500 underline">プロフィールを編集する</a>
    </div>

    {{-- 購入済み商品一覧 --}}
    <div class="mt-10 max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-2">購入済み商品一覧</h2>
        @if ($purchasedItems->count() > 0)
            <ul class="space-y-2">
                @foreach ($purchasedItems as $purchase)
                    <li class="border rounded p-4 bg-gray-50">
                        <p><strong>商品名：</strong> {{ $purchase->item->name ?? '商品データなし' }}</p>
                        <p><strong>購入日：</strong> {{ $purchase->created_at->format('Y-m-d') }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">購入済みの商品はありません。</p>
        @endif
    </div>

    {{-- 出品済み商品一覧 --}}
    <div class="mt-10 max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-2">出品済み商品一覧</h2>
        @if ($listedItems->count() > 0)
            <ul class="space-y-2">
                @foreach ($listedItems as $item)
                    <li class="border rounded p-4 bg-gray-50">
                        <p><strong>商品名：</strong> {{ $item->name }}</p>
                        <p><strong>出品日：</strong> {{ $item->created_at->format('Y-m-d') }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">出品済みの商品はありません。</p>
        @endif
    </div>
</body>
</html>