<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SessionProduct extends Model  implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $table = 'product_session';

    protected $fillable = [
        'session_id',
        'product_id',
        'number_of_items',
        'paid',
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

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
