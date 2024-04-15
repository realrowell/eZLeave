<?php

namespace App\Models;

use Faker\Provider\ar_EG\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sap_id_number',
        'contact_number',
        'address_id',
        'employee_position_id',
        'birthdate',
        'gender_id',
        'employment_status_id',
        'marital_status_id',
        'status_id',
        'date_hired',
    ];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'emp-';
            $model->id = IdGenerator::generate(['table' => 'employees', 'length' => 20, 'prefix' =>$prefix.date('ym').time()]);
        });
    }

    public function users(){
        return $this -> belongsTo(User::class,'user_id','id');
    }
    public function employee_positions(){
        return $this -> hasOne(EmployeePosition::class,'id','employee_position_id');
    }
    public function employment_statuses(){
        return $this -> hasOne(EmploymentStatus::class,'id','employment_status_id');
    }
    public function marital_statuses(){
        return $this -> hasOne(MaritalStatus::class,'id','marital_status_id');
    }
    public function genders(){
        return $this -> hasOne(Gender::class,'id','gender_id');
    }
    public function employee_addresses(){
        return $this -> hasOne(EmployeeAddress::class,'id','address_id');
    }
}
