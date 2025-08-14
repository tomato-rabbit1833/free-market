<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
public function show()
{
    $user = Auth::user();

    // Eloquentリレーションで購入・出品済み商品を取得
    $purchasedItems = $user->purchasedItems()->with('item')->get();
    $listedItems = $user->listedItems()->get();

    return view('profile.show', compact('user', 'listedItems', 'purchasedItems'));
}
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function index()
{
    $user = Auth::user();

    $purchasedItems = $user->purchasedItems()->with('item')->get()->pluck('item');
    $listedItems = $user->items;
    $likedItems = $user->likedItems; // 追加

    return view('profile.index', compact('purchasedItems', 'listedItems', 'likedItems'));
}



    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        // プロフィール画像の保存処理
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('public/profile_images');
            $user->profile_image = basename($path);
        }

        $user->name = $request->name;
        $user->zipcode = $request->zipcode;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'プロフィールを更新しました。');
    }
}