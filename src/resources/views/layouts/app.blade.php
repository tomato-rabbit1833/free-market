<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'フリマアプリ') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- ヘッダー -->
    <header class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">
                <a href="{{ route('items.index') }}">フリマアプリ</a>
            </h1>

            <nav class="flex items-center space-x-4">
                <a href="{{ route('items.index') }}" class="hover:underline">商品一覧</a>
                <a href="{{ route('wishlist.index') }}" class="hover:underline">マイリスト</a>
                <a href="{{ route('profile.index') }}" class="hover:underline">プロフィール</a>
            </nav>
        </div>
    </header>

    <!-- メイン -->
    <main class="max-w-7xl mx-auto px-4">
        @yield('content')
    </main>

    <!-- フッター -->
    <footer class="mt-10 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} フリマアプリ
    </footer>
</body>
</html>
