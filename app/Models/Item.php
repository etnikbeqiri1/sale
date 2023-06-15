<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Item extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'name',
        'state',
        'enabled',
        'item_pricing_id',
        'created_at',
        'updated_at',
        'order_number',
    ];

    protected $casts = [
        'state' => 'integer',
        'enabled' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function itemPricing()
    {
        return $this->belongsTo(ItemPricing::class);
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

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
