<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * マイリスト一覧を表示
     */
    public function index()
    {
        $user = Auth::user();

        // ユーザーが「いいね」した商品だけ取得
        $items = $user->wishlistedItems()
            ->with('categories', 'purchase') // カテゴリ・購入情報も取得
            ->paginate(6);

        return view('wishlist.index', compact('items'));
    }

    /**
     * 商品をマイリストに追加
     */
    public function store($id)
    {
        $user = Auth::user();
        $user->wishlistedItems()->attach($id);

        return back()->with('success', 'マイリストに追加しました！');
    }

    /**
     * 商品をマイリストから削除
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $user->wishlistedItems()->detach($id);

        return back()->with('success', 'マイリストから削除しました。');
    }
}
