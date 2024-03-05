<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Status extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'status_title'
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'sta-';
            $model->id = IdGenerator::generate(['table' => 'statuses', 'length' => 8, 'prefix' =>$prefix]);
        });
    }
}
