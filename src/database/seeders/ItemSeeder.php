<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
{
    $items = [
    ['name' => '腕時計', 'price' => 15000, 'description' => 'スタイリッシュなデザインのメンズ腕時計', 'condition' => '良好', 'image' => 'watch.jpg'],
    ['name' => 'HDD', 'price' => 5000, 'description' => '高速で信頼性の高いハードディスク', 'condition' => '目立った傷や汚れなし', 'image' => 'hdd.jpg'],
    ['name' => '玉ねぎ3束', 'price' => 300, 'description' => '新鮮な玉ねぎ3束のセット', 'condition' => 'やや傷や汚れあり', 'image' => 'onion.jpg'],
    ['name' => '革靴', 'price' => 4000, 'description' => 'クラシックなデザインの革靴', 'condition' => '状態が悪い', 'image' => 'shoes.jpg'],
    ['name' => 'ノートPC', 'price' => 45000, 'description' => '高性能なノートパソコン', 'condition' => '良好', 'image' => 'laptop.jpg'],
    ['name' => 'マイク', 'price' => 8000, 'description' => '高音質のレコーディング用マイク', 'condition' => '目立った傷や汚れなし', 'image' => 'mic.jpg'],
    ['name' => 'ショルダーバッグ', 'price' => 3500, 'description' => 'おしゃれなショルダーバッグ', 'condition' => 'やや傷や汚れあり', 'image' => 'bag.jpg'],
    ['name' => 'タンブラー', 'price' => 500, 'description' => '使いやすいタンブラー', 'condition' => '状態が悪い', 'image' => 'tumbler.jpg'],
    ['name' => 'コーヒーミル', 'price' => 4000, 'description' => '手動のコーヒーミル', 'condition' => '良好', 'image' => 'grinder.jpg'],
    ['name' => 'メイクセット', 'price' => 2500, 'description' => '便利なメイクアップセット', 'condition' => '目立った傷や汚れなし', 'image' => 'makeup.jpg'],
];


        foreach ($items as $item) {
            Item::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'description' => $item['description'],
                'condition' => $item['condition'],
                'user_id' => 1, // 必ず user_id=1 が存在していること
                'stock' => 1,
            ]);
        }
    }
}
