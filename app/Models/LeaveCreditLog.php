<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCreditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_application_rn',
        'leave_credit_approval_id',
        'employee_leave_credits_id',
        'leave_days_credit',
        'reason_note',
        'status_id',
        'employee_id',
        'fiscal_year_id',
    ];
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'lcl-';
            $model->id = IdGenerator::generate(['table' => 'leave_credit_logs', 'length' => 20, 'prefix' =>$prefix.date('ymdHis')]);
        });
    }
    public function statuses(){
        return $this -> hasOne(Status::class,'id','status_id');
    }
    public function fiscal_years(){
        return $this -> hasOne(FiscalYear::class,'id','fiscal_year_id');
    }
    public function employee_leave_credits(){
        return $this -> hasOne(EmployeeLeaveCredit::class,'id','employee_leave_credits_id');
    }
    public function leave_applications(){
        return $this -> hasOne(LeaveApplication::class,'reference_number','leave_application_rn');
    }
}
