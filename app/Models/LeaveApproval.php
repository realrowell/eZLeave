<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LeaveApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_application_reference',
        'approver_id',
        'status_id'
    ];
    
    protected $primary = 'id';
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'apv-';
            $model->id = IdGenerator::generate(['table' => 'leave_application_notes', 'length' => 16, 'prefix' =>$prefix.date('ymdHism')]);
        });
    }

    public function leave_applications(){
        return $this -> hasOne(LeaveApplication::class,'reference_number','leave_application_reference');
    }
    public function employees(){
        return $this -> hasOne(Employee::class,'id','approver_id');
    }
    public function statuses(){
        return $this -> hasOne(Status::class,'id','status_id');
    }
}
