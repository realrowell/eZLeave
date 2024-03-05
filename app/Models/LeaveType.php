<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LeaveType extends Model
{
    use HasFactory;

    public $incrementing = false; 

    protected $fillable = [
        'leave_type_title',
        'leave_type_description',
        'leave_days_per_year',
        'max_leave_days',
        'reset_date',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'ltp-1';
            $model->id = IdGenerator::generate(['table' => 'leave_types', 'length' => 12, 'prefix' =>$prefix]);
        });
    }
}
