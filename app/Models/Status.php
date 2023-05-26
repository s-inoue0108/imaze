<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

// Userモデル
use App\Models\User;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    // リレーション

    public function user() {
        return $this->belongsTo(User::class);
    }
}
