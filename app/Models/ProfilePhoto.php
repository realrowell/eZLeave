<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePhoto extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primary = 'id';

    protected $fillable = [
        'profile_photo',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'prof-';
            $model->id = IdGenerator::generate(['table' => 'profile_photos', 'length' => 20, 'prefix' =>$prefix.date('ymHis')]);
        });
    }

    public function users(){
        return $this -> hasOne(User::class,'id','user_id');
    }
}
