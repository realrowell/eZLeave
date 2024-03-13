<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionTitles extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primary = 'id';

    protected $fillable = [
        'position_title',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'pst-';
            $model->id = IdGenerator::generate(['table' => 'position_titles', 'length' => 8, 'prefix' =>$prefix]);
        });
    }
}
