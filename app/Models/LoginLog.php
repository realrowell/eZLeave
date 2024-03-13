<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_time'
    ];

    public $incrementing = false; 
    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'log-';
            $model->id = IdGenerator::generate(['table' => 'login_logs', 'length' => 25, 'prefix' =>$prefix.date('ymdHism')]);
        });
    }

    public function users(){
        return $this -> hasOne(User::class,'id','user_id');
    }
}
