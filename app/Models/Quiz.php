<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Userモデル
use App\Models\User;

// Correctモデル
use App\Models\Correct;

// Bookmarkモデル
use App\Models\Bookmark;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // リレーション

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function corrects() {
        return $this->hasMany(Correct::class);
    }

    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }
}
