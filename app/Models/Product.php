<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'internal_name',
        'price',
        'image',
        'stock',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_at = $model->updated_at = now();
        });

        self::updating(function ($model) {
            $model->updated_at = now();
        });
    }
}
