<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function months(){
        return $this->hasMany(Month::class);
    }

    public function days(){
        return $this->hasMany(Day::class);
    }

    public function challenges(){
        return $this->hasMany(Challenge::class);
    }
}
