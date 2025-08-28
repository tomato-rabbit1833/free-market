<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'フリマアプリ')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto">
            <a href="{{ route('items.index') }}" class="font-bold">フリマアプリ</a>
            <a href="{{ route('items.create') }}" class="ml-4">商品出品</a>
        </div>
    </nav>

    <main class="container mx-auto py-6">
        @yield('content')
    </main>
</body>
</html>
