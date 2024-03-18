<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaIp extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'area_id',
        'ip_id',
        'is_active'
    ];

    /**
     * Get the area that owns the AreaIp
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area(): BelongsTo {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    /**
     * Get the ip that owns the AreaIp
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ip(): BelongsTo {
        return $this->belongsTo(Ip::class, 'ip_id', 'id');
    }

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->id();
            $model->save();
        });
    }
}
