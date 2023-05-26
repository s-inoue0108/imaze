<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

// Quizモデル
use App\Models\Quiz;

class Correct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    // リレーション

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }
}
