<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_cargo',
        'area_ip_id',
        'apellido_paterno',
        'apellido_materno',
        'nombre',
        'dni',
        'correo_institucional',
        'nombre_equipo',
        'usuario_red',
        'procesador',
        'memoria',
        'sistema_opreativo',
        'mac_dispositivo',
        'is_active'
    ];

    /**
     * Get the areaIp that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area_ip(): BelongsTo
    {
        return $this->belongsTo(AreaIp::class, 'area_ip_id', 'id');
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
            return $query->where('name_cargo', 'LIKE', "%{$search}%")
                ->orWhere('nombre', 'LIKE', "%{$search}%");
        }
    }
}
