<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ItemPricing extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'item_pricing';

    protected $fillable = [
        'name',
        'enabled',
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'enabled' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pricing()
    {
        return $this->hasMany(Price::class);
    }

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

    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1);
    }
}
