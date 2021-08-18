<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTraining extends Model
{
    use HasFactory;

    protected $table = 'data_trainings';

    protected $fillable = [
        'title',
        'brand',
        'size',
        'model',
        'brand_id'
    ];

    public function scopeOfBrand($query, $value = true)
    {
        return $query->where('brand', $value);
    }

    public function scopeOfSize($query, $value = true)
    {
        return $query->where('size', $value);
    }

    public function scopeOfModel($query, $value = true)
    {
        return $query->where('model', $value);
    }
}
