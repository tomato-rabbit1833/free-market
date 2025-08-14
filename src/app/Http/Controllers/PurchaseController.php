<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
use Illuminate\Http\Request;


class PurchaseController extends Controller
{

public function index()
    {
        $user = Auth::user();

        // 購入履歴（purchases テーブルに基づく）
        $purchasedItems = Purchase::with('item')
            ->where('user_id', $user->id)
            ->latest('purchased_at')
            ->get();

        // 出品履歴（items テーブルに基づく）
        $listedItems = Item::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('profile.index', compact('purchasedItems', 'listedItems'));
    }

    public function create($id)
    {
        $items = [
            [
                'id' => 1,
                'name' => '腕時計',
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'condition' => '良好',
                'image' => 'watch.jpg',
            ],
            [
                'id' => 2,
                'name' => 'HDD',
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク',
                'condition' => 'やや傷や汚れあり',
                'image' => 'hdd.jpg',
            ],
            [
                'id' => 3,
                'name' => '玉ねぎ3束',
                'price' => 300,
                'description' => '新鮮な玉ねぎ3束のセット',
                'condition' => '目立った傷や汚れなし',
                'image' => 'onion.jpg',
            ],
            [
                'id' => 4,
                'name' => '革靴',
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴',
                'condition' => '良好',
                'image' => 'shoes.jpg',
            ],
            [
                'id' => 5,
                'name' => 'ノートPC',
                'price' => 45000,
                'description' => '高性能なノートパソコン',
                'condition' => '目立った傷や汚れなし',
                'image' => 'laptop.jpg',
            ],
            [
                'id' => 6,
                'name' => 'マイク',
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク',
                'condition' => 'やや傷や汚れあり',
                'image' => 'mic.jpg',
            ],
            [
                'id' => 7,
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ',
                'condition' => '状態が悪い',
                'image' => 'bag.jpg',
            ],
            [
                'id' => 8,
                'name' => 'タンブラー',
                'price' => 500,
                'description' => '使いやすいタンブラー',
                'condition' => '良好',
                'image' => 'tumbler.jpg',
            ],
            [
                'id' => 9,
                'name' => 'コーヒーミル',
                'price' => 4000,
                'description' => '手動のコーヒーミル',
                'condition' => '目立った傷や汚れなし',
                'image' => 'mill.jpg',
            ],
            [
                'id' => 10,
                'name' => 'メイクセット',
                'price' => 2500,
                'description' => '便利なメイクアップセット',
                'condition' => 'やや傷や汚れあり',
                'image' => 'makeup.jpg',
            ],
            // ...他のダミーデータもここに
        ];

        $item = collect($items)->firstWhere('id', $id);

        if (!$item) {
            abort(404);
        }

        return view('purchase.create', compact('item'));
    }

    // 商品購入処理（次のステップで追加）
  public function store(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'payment_method' => 'required|in:card,convenience',
        'shipping_address' => 'required|string|max:255',
    ]);

    $paymentMethod = $request->input('payment_method');

    $items = [
        ['id' => 1, 'name' => '腕時計'],
        ['id' => 2, 'name' => 'HDD'],
        ['id' => 3, 'name' => '玉ねぎ3束'],
        ['id' => 4, 'name' => 'クラシックなデザインの革靴'],
        ['id' => 5, 'name' => '高性能なノートパソコン'],
        ['id' => 6, 'name' => '高音質のレコーディング用マイク'],
        ['id' => 7, 'name' => 'おしゃれなショルダーバッグ'],
        ['id' => 8, 'name' => '使いやすいタンブラー'],
        ['id' => 9, 'name' => '手動のコーヒーミル'],
        ['id' => 10, 'name' => '便利なメイクアップセット'],
    ];

    $item = collect($items)->firstWhere('id', $id);
    if (!$item) {
        abort(404);
    }

    Purchase::create([
        'user_id' => Auth::id(),
        'item_id' => $id,
        'quantity' => $request->input('quantity'),
        'purchased_at' => Carbon::now(),
        'payment_method' => $paymentMethod,
        'shipping_address' => $request->input('shipping_address'), 
    ]);

    return redirect()->route('purchase.complete')->with('message', $item['name'] . ' を' . ($paymentMethod === 'card' ? 'カード' : 'コンビニ') . 'で購入しました。');
}

public function complete()
{
    return view('purchase.complete');
}


    // 配送先住所変更画面の表示
    public function editAddress($id)
    {
        return view('purchase.edit_address', ['id' => $id]);
    }

    
public function show($id)
{
    $item = Item::findOrFail($id);
    return view('purchase.show', compact('item'));
}

    // 配送先住所の更新
    public function updateAddress(Request $request, $id)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
        ]);

        session(['shipping_address' => $request->shipping_address]);

        return redirect()->route('purchase.create', ['id' => $id])
                         ->with('success', '住所が変更されました。');
    }
}
