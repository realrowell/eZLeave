<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCreditApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type_id',
        'employee_id',
        'leave_days_credit',
        'status_id',
        'fiscal_year_id'
    ];
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'lca-';
            $model->id = IdGenerator::generate(['table' => 'leave_credit_approvals', 'length' => 20, 'prefix' =>$prefix.date('ymdHsi')]);
        });
    }
}
