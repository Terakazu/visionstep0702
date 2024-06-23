<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visionboard extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'user_id','board_name'];
        
         public function elements()
    {
        return $this->hasMany(Element::class);
    }
}
