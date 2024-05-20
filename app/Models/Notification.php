<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'body',
        'notification_type_id',
        'author_id',
        'employee_id',
        'is_open',
        'priority_order_id',
        'status_id'
    ];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'notif-';
            $model->id = IdGenerator::generate(['table' => 'notifications', 'length' => 30, 'prefix' =>$prefix.date('ymdHism')]);
        });
    }
}
