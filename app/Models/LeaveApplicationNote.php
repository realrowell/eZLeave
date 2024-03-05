<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LeaveApplicationNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_application_reference',
        'reason_note',
        'employee_id'
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'note-';
            $model->id = IdGenerator::generate(['table' => 'leave_application_notes', 'length' => 16, 'prefix' =>$prefix.date('ymd')]);
        });
    }

    public function leave_applications(){
        return $this -> hasOne(LeaveApplication::class,'reference_number','leave_application_reference');
    }

    public function employees(){
        return $this -> hasOne(Employee::class,'id','employee_id');
    }
}
