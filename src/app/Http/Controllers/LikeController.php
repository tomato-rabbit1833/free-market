<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class LikeController extends Controller
{
    public function store($id)
    {
        $user = Auth::user();
        $user->likedItems()->attach($id); // いいねを追加
        return back();
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $user->likedItems()->detach($id); // いいねを削除
        return back();
    }
}
