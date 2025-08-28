<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'description',
        'condition',   // ← 追加（商品の状態）
        'image_path',
    ];

    // 出品者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // カテゴリ（多対多）
    public function categories()
{
    // 中間テーブル item_category を使う
    return $this->belongsToMany(Category::class, 'item_category');
}

    

    // いいね（1対多）
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // 複数画像対応（もし使う場合）
    public function images()
    {
        return $this->hasMany(\App\Models\ItemImage::class);
    }

    // 購入情報
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    // 出品者（seller_id列を使う場合）
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // ウィッシュリスト（お気に入り）
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    // いいねしたユーザー一覧
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    // コメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
