<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;

    protected $primary = 'id';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'usr-';
            $model->id = IdGenerator::generate(['table' => 'users', 'length' => 25, 'prefix' =>$prefix.date('ym').time()]);
        });
    }

    public function employees(){
        return $this -> hasOne(Employee::class,'user_id','id');
    }

    public function suffixes(){
        return $this -> hasOne(Suffix::class,'id','suffix_id');
    }

    public function roles(){
        return $this -> hasOne(Role::class,'id','role_id');
    }

    public function statuses(){
        return $this -> hasOne(Status::class,'id','status_id');
    }

    public function profile_photos(){
        return $this -> hasOne(ProfilePhoto::class,'user_id','id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix_id',
        'email',
        'user_name',
        'password',
        'role_id',
        'status_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
