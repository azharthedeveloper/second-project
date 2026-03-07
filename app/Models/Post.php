<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $hidden = [
        'title',
    ];

    public function scopeGreaterThanFive($query, $from = 0, $to = 100){
        return $query->where('id', '>', $from)->where('id', '<', $to);
    }
}
