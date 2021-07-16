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
}
