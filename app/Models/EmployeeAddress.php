<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EmployeeAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'address_line_1',
        'city',
        'province',
        'region',
        'status_id'
    ];

    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'ead-';
            $model->id = IdGenerator::generate(['table' => 'employee_addresses', 'length' => 16, 'prefix' =>$prefix.date('Ym')]);
        });
    }
}
