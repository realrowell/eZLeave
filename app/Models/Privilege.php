<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Privilege extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'privilege_title',
        'privilege_description'
    ];

    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'prv-';
            $model->id = IdGenerator::generate(['table' => 'privileges', 'length' => 8, 'prefix' =>$prefix]);
        });
    }
}
