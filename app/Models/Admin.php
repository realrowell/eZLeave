<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'privilege_id',
        'status_id'
    ];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'adm-';
            $model->id = IdGenerator::generate(['table' => 'admins', 'length' => 20, 'prefix' =>$prefix.date('ym').time()]);
        });
    }
}
