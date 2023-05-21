<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Userモデル
use App\Models\User;

class Status extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // リレーション

    public function user() {
        return $this->belongsTo(User::class);
    }
}
