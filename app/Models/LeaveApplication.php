<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type_id',
        'start_date',
        'end_date',
        'duration',
        'attachment',
        'employee_id',
        'approver_id',
        'employee_leave_credit_id',
        'status_id',
    ];

    protected $primaryKey = 'id';
    public $incrementing = false;
    

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'lms-';
            $prefixref = 'RN-';
            $model->id = IdGenerator::generate(['table' => 'leave_applications', 'length' => 20, 'prefix' =>$prefix.date('ym').time()]);
            $model->reference_number = IdGenerator::generate(['table' => 'leave_applications', 'length' => 15, 'prefix' =>$prefixref.date('ymdHism')]);
        });
    }

    public function employees(){
        return $this -> hasOne(Employee::class,'id','employee_id');
    }
    public function approvers(){
        return $this -> hasOne(Employee::class,'id','approver_id');
    }
    public function leavetypes(){
        return $this -> hasOne(LeaveType::class,'id','leave_type_id');
    }
    public function statuses(){
        return $this -> hasOne(Status::class,'id','status_id');
    }
    // public function leave_approvals(){
    // return $this->hasMany('LeaveApprovals'); 
    // }
}
