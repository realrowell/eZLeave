<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AreaOfAssignment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'location_address',
        'location_desc',
        'embedded_google_map'
    ];


    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'area-';
            $model->id = IdGenerator::generate(['table' => 'area_of_assignments', 'length' => 16, 'prefix' =>$prefix.date('Ymd')]);
        });
    }

    
}
