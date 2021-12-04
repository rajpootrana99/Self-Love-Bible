<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'month_id',
        'day_id',
        'name',
        'detail',
    ];

    public function day(){
        return $this->belongsTo(Day::class);
    }

    public function month(){
        return $this->belongsTo(Month::class);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
