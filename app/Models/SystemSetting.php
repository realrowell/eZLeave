<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'embed_map_provider'
    ];

    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'sys-';
            $model->id = IdGenerator::generate(['table' => 'system_settings', 'length' => 12, 'prefix' =>$prefix.date('Ym')]);
        });
    }
}
