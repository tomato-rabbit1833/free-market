<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Comment;

class ItemController extends Controller
{
    /**
     * ダミーデータ
     */
    private function dummyItems()
    {
        return [
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
        ];
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
{
    // DBから商品取得
    $query = Item::query();

    // 検索条件
    if ($keyword = $request->input('keyword')) {
        $query->where('name', 'like', "%{$keyword}%");
    }
    if ($categoryId = $request->input('category_id')) {
        $query->whereHas('categories', function($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        });
    }
    if ($minPrice = $request->input('min_price')) {
        $query->where('price', '>=', $minPrice);
    }
    if ($maxPrice = $request->input('max_price')) {
        $query->where('price', '<=', $maxPrice);
    }

    // 並び替え
    $sort = $request->input('sort');
    switch ($sort) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'newest':
            $query->orderBy('created_at', 'desc');
            break;
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    // DBの商品だけページネーション
    $dbItems = $query->paginate(6);

    // ダミーデータ（固定）
    $dummyItems = collect($this->dummyItems());

    // 表示用に結合（ダミー + DBのページネーション）
    // → ページネーションは DB のみ有効
    $items = $dummyItems->concat($dbItems->items());

    $categories = Category::all();

    return view('items.index', [
        'items' => $items,
        'categories' => $categories,
        'dbItems' => $dbItems, // ページネーション用に渡す
    ]);
}


    /**
     * 商品詳細
     */
    public function show($id)
    {
        $item = Item::with('comments.user')->findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
     * 出品画面
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * 出品処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'condition' => 'required|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
        }

        $item = Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'condition' => $request->condition,
            'image_path' => $path,
        ]);

        if ($request->filled('categories')) {
            $item->categories()->sync($request->categories);
        }

        return redirect()->route('items.index')->with('success', '商品を出品しました！');
    }
}
