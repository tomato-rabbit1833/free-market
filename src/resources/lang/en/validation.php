<?php

return [
    'required' => ':attribute は必須項目です。',
    'email' => ':attribute の形式が正しくありません。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'confirmed' => ':attribute と確認用の入力が一致しません。',
    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認用）',
    ],
];
