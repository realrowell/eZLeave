<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class HrStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'privilege_id'
    ];
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'hrs-';
            $model->id = IdGenerator::generate(['table' => 'hr_staff', 'length' => 20, 'prefix' =>$prefix.date('ym').time()]);
        });
    }
}
