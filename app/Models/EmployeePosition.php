<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EmployeePosition extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'employee_id',
        'position_id',
        'subdepartment_id',
        'area_of_assignment_id',
        'reports_to_id',
        'status_id'
    ];

    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'epo-';
            $model->id = IdGenerator::generate(['table' => 'employee_positions', 'length' => 16, 'prefix' =>$prefix.date('ym')]);
        });
    }

    public function positions(){
        return $this -> hasOne(Position::class,'id','position_id');
    }
    public function subdepartments(){
        return $this -> hasOne(SubDepartment::class,'id','subdepartment_id');
    }
    public function area_of_assignments(){
        return $this -> hasOne(AreaOfAssignment::class,'id','area_of_assignment_id');
    }
    public function reports_tos(){
        return $this -> hasOne(Employee::class,'id','reports_to_id');
    }
}
