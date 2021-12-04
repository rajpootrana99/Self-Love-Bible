<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitness extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'duration',
        'type',
        'media',
        'thumbnail',
    ];

    public function getTypeAttribute($attribute){
        return $this->typeOptions()[$attribute] ?? 0;
    }

    public function typeOptions(){
        return [
            1 => 'Outdoor',
            0 => 'Indoor',
        ];
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
