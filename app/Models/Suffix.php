<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Suffix extends Model
{
    use HasFactory;

    protected $fillable = [
        'suffix_title',
        'status_id',
    ];
    public $incrementing = false; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'suf-';
            $model->id = IdGenerator::generate(['table' => 'suffixes', 'length' => 8, 'prefix' =>$prefix.date('Y')]);
        });
    }
}
