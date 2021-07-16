<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'name'
    ];

    public function dataTrainings()
    {
        return $this->hasMany(DataTraining::class, 'brand_id', 'id');
    }
}
