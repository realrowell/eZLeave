<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'role_title'
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'rol-';
            $model->id = IdGenerator::generate(['table' => 'roles', 'length' => 8, 'prefix' =>$prefix]);
        });
    }
}
