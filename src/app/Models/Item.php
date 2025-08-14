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
        'image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function images()
{
    return $this->hasMany(\App\Models\ItemImage::class);
}

    

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
    public function seller()
{
    return $this->belongsTo(User::class, 'seller_id');
}

public function wishlistedBy()
{
    return $this->belongsToMany(User::class, 'wishlists');
}

public function likedByUsers()
{
    return $this->belongsToMany(User::class, 'likes')->withTimestamps();
}

public function comments()
{
    return $this->hasMany(Comment::class);
}


}
