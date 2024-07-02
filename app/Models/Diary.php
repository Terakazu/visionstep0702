<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
   protected $fillable = [
        'user_id',
        'calendar_date',
        'image',
        'body',
        'goodpoint',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
