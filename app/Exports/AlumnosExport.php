<?php

namespace App\Exports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class AlumnosExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Alumno::with(['sede', 'instructor']);

        // filtros
        if ($this->request->filled('sede')) {
            $query->where('sede_id', $this->request->sede);
        }
        if ($this->request->filled('instructor')) {
            $query->where('instructor_id', $this->request->instructor);
        }
        if ($this->request->filled('grado')) {
            $query->where('grado', $this->request->grado);
        }

        return $query->get()->map(function ($alumno) {
            $dias = $alumno->dias_desde_ultimo_examen;
            $años = $dias ? floor($dias / 365) : 0;
            $meses = $dias ? floor(($dias % 365) / 30) : 0;
            $restoDias = $dias ? $dias % 30 : 0;

            return [
                'Nombre' => $alumno->nombre,
                'Apellido' => $alumno->apellido,
                'RUT' => $alumno->rut,
                'Teléfono' => $alumno->telefono,
                'Email' => $alumno->email,
                'Dirección' => $alumno->direccion,
                'Sede' => $alumno->sede->nombre ?? '-',
                'Instructor' => $alumno->instructor ? $alumno->instructor->nombre . ' ' . $alumno->instructor->apellido : '-',
                'Grado' => $alumno->grado ?? '-',
                'Fecha de Nacimiento' => $alumno->fecha_nacimiento,
                'Edad' => $alumno->edad . ' años',
                'Fecha Último Examen' => $alumno->fecha_ultimo_examen ?? '-',
                'Tiempo desde Último Examen' => $dias
                    ? "{$años} años, {$meses} meses, {$restoDias} días"
                    : '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'RUT',
            'Teléfono',
            'Email',
            'Dirección',
            'Sede',
            'Instructor',
            'Grado',
            'Fecha de Nacimiento',
            'Edad',
            'Fecha Último Examen',
            'Tiempo desde Último Examen',
        ];
    }
}