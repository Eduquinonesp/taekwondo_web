<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'rut',
        'telefono',
        'email',
        'direccion',
        'sede_id',
        'instructor_id',
        'fecha_ultimo_examen',
        'tiene_apoderado',
        'grado',
    ];

    protected $casts = [
        'tiene_apoderado'      => 'boolean',
        'fecha_nacimiento'     => 'date',
        'fecha_ultimo_examen'  => 'date',
    ];

    // Relaciones
    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    // ===== Atributos calculados =====

    // Edad en años
    public function getEdadAttribute()
    {
        return $this->fecha_nacimiento
            ? Carbon::parse($this->fecha_nacimiento)->age
            : null;
    }

    // Días totales desde el último examen (entero)
    public function getDiasDesdeUltimoExamenAttribute()
    {
        return $this->fecha_ultimo_examen
            ? Carbon::parse($this->fecha_ultimo_examen)->diffInDays(now())
            : null;
    }

    // Texto “X años, Y meses y Z días” desde el último examen
    public function getTiempoDesdeUltimoExamenAttribute()
    {
        if (!$this->fecha_ultimo_examen) {
            return null;
        }

        $diff = Carbon::parse($this->fecha_ultimo_examen)->diff(now());

        $anios = $diff->y;
        $meses = $diff->m;
        $dias  = $diff->d;

        $texto = "";
        if ($anios > 0) {
            $texto .= $anios . " año" . ($anios > 1 ? "s" : "");
        }
        if ($meses > 0) {
            $texto .= ($texto ? ", " : "") . $meses . " mes" . ($meses > 1 ? "es" : "");
        }
        if ($dias > 0) {
            $texto .= ($texto ? " y " : "") . $dias . " día" . ($dias > 1 ? "s" : "");
        }

        return $texto ?: "0 días";
    }
}