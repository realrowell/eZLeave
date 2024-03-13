<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionLevel extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primary = 'id';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'psl-';
            $model->id = IdGenerator::generate(['table' => 'position_levels', 'length' => 8, 'prefix' =>$prefix]);
        });
    }

    public function positions(){
        return $this -> belongsTo(Position::class,'position_level_id','id');
    }
}
