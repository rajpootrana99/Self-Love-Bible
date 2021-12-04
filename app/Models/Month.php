<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'name',
    ];

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function days(){
        return $this->hasMany(Day::class);
    }

    public function challenges(){
        return $this->hasMany(Challenge::class);
    }
}
