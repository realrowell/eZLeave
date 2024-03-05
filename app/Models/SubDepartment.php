<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SubDepartment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sub_department_title',
        'department_id',
        'status_id',
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'sdp-';
            $model->id = IdGenerator::generate(['table' => 'sub_departments', 'length' => 12, 'prefix' =>$prefix.date('ym')]);
        });
    }

    public function departments(){
        return $this -> hasOne(Department::class,'id','department_id');
    }
}
