<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Gender extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'gender_title'
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'gen-';
            $model->id = IdGenerator::generate(['table' => 'genders', 'length' => 8, 'prefix' =>$prefix]);
        });
    }
}
