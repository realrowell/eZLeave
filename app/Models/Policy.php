<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Policy extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'policy_title',
        'policy_body',
        'author_id'
    ];

    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'plc-';
            $model->id = IdGenerator::generate(['table' => 'policies', 'length' => 12, 'prefix' =>$prefix.date('ym')]);
        });
    }
}
