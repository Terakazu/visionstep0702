<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $fillable = [
        'element_type',
        'element_data',
        'image',
        'position_x',
        'position_y',
        'visionboard_id', // 追加したカラムを追加
    ];
    public function visionboard()
    {
        return $this->belongsTo(Visionboard::class);
    }
}
