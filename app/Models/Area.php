<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'abreviation',
        'cantidad',
        'ip_inicio',
        'ip_fin',
        'is_active'
    ];

    /**
     * Get all of the cargos for the Area
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ips(): BelongsToMany {
        return $this->belongsToMany(Ip::class, 'area_ips', 'area_id', 'ip_id')->withPivot('id', 'is_active')->withTimestamps();
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



    public function scopeSearch($query, $search) {
        if ($search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('abreviation', 'LIKE', "%{$search}%");
        }
    }
}
