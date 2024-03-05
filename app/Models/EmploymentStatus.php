<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EmploymentStatus extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'employment_status_title'
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'ems-';
            $model->id = IdGenerator::generate(['table' => 'employment_statuses', 'length' => 8, 'prefix' =>$prefix]);
        });
    }
}
