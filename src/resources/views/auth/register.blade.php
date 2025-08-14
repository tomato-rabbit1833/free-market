{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">会員登録</h1>

        {{-- 全体エラー表示（任意） --}}
        {{-- 
@if ($errors->any())
    <div class="mb-4">
        <ul class="text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <li>・{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
--}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- お名前 --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">お名前</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border rounded px-3 py-2">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- メールアドレス --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border rounded px-3 py-2">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">パスワード</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2">
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- パスワード確認 --}}
            <div class="mb-6">
                <label class="block mb-1 font-semibold">パスワード（確認用）</label>
                <input type="password" name="password_confirmation"
                    class="w-full border rounded px-3 py-2">
                @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- 送信ボタン --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                登録する
            </button>
        </form>
    </div>
</body>
</html>