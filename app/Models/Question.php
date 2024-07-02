<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   
   protected $fillable = ['question_text', 'category_id'];
   
   public function category()
    {
        return $this->belongsTo(Category::class);
    }   
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
