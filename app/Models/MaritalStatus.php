<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MaritalStatus extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'marital_status_title'
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'mar-';
            $model->id = IdGenerator::generate(['table' => 'marital_statuses', 'length' => 8, 'prefix' =>$prefix]);
        });
    }
}
