<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EmployeeLeaveCredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type_id',
        'employee_id',
        'leave_days_credit',
        'status_id',
        'fiscal_year'
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'elc-';
            $model->id = IdGenerator::generate(['table' => 'employee_leave_credits', 'length' => 20, 'prefix' =>$prefix.date('ym')]);
        });
    }

    public function employees(){
        return $this -> hasOne(Employee::class,'id','employee_id');
    }
    public function leavetypes(){
        return $this -> hasOne(LeaveType::class,'id','leave_type_id');
    }
    public function statuses(){
        return $this -> hasOne(Status::class,'id','status_id');
    }
}
