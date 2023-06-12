<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Session extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $table = 'session';

    protected $fillable = [
        'paid',
        'started_at',
        'duration',
        'ended_at',
        'price_id',
        'item_id',
    ];


    protected $casts = [
        'paid' => 'boolean',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'duration' => 'integer',
    ];

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->started_at = now();
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('number_of_items')
            ->withPivot('paid')
            ->withTimestamps();
    }
}
