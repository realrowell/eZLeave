<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiscal_year_title',
        'fiscal_year_description',
        'fiscal_year_start',
        'fiscal_year_end',
        'status_id',
    ];
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'fy-';
            $model->id = IdGenerator::generate(['table' => 'fiscal_years', 'length' => 8, 'prefix' =>$prefix.date('ym')]);
        });
    }

    public function statuses(){
        return $this -> hasOne(Status::class,'id','status_id');
    }
}
