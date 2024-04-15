<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_title',
        'status_id',
    ];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'dpt-';
            $model->id = IdGenerator::generate(['table' => 'departments', 'length' => 8, 'prefix' =>$prefix]);
        });
    }

    public function subdepartments(){
        return $this -> belongsTo(SubDepartment::class,'id','department_id');
    }
}
