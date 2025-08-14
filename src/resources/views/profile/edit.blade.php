{{-- プロフィール編集 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール編集</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">プロフィール編集</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>・{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block font-bold mb-1" for="name">ユーザー名</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1" for="zipcode">郵便番号</label>
                <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode', $user->zipcode) }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1" for="address">住所</label>
                <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1" for="profile_image">プロフィール画像</label>
                <input type="file" name="profile_image" id="profile_image" class="w-full">
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">更新する</button>
            </div>
        </form>

        <a href="{{ route('profile.show') }}" class="text-blue-500 inline-block mt-4">← プロフィールに戻る</a>
    </div>
</body>
</html>
