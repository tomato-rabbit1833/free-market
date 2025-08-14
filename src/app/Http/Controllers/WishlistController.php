<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;



class WishlistController extends Controller
{
    // 登録
    public function store($id)
    {
        $user = Auth::user();

        // すでに登録されていないか確認
        $exists = Wishlist::where('user_id', $user->id)
                          ->where('item_id', $id)
                          ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => $user->id,
                'item_id' => $id,
            ]);
        }

        return redirect()->back()->with('success', 'マイリストに追加しました。');
    }

    // 削除
    public function destroy($id)
    {
        $user = Auth::user();

        Wishlist::where('user_id', $user->id)
                ->where('item_id', $id)
                ->delete();

        return redirect()->back()->with('success', 'マイリストから削除しました。');
    }

    public function index()
{
    $user = Auth::user();
    $wishlistedItems = $user->wishlistedItems; // リレーションを利用

    return view('wishlist.index', compact('wishlistedItems'));
}
}

