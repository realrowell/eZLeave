<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_title',
        'position_description',
        'subdepartment_id',
        'status_id'
    ];
    public $incrementing = false; 

    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'pos-';
            $model->id = IdGenerator::generate(['table' => 'positions', 'length' => 12, 'prefix' =>$prefix.date('ym')]);
        });
    }

    public function employees(){
        return $this -> belongsTo(Employee::class,'position_id','id');
    }
    // public function departments(){
    //     return $this -> hasOne(department::class,'department_id','id');
    // }
    public function subdepartments(){
        return $this -> hasOne(SubDepartment::class,'id','subdepartment_id');
    }
}
