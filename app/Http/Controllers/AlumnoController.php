<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Sede;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumnosExport;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumno::with(['sede', 'instructor']);

        // filtros
        if ($request->filled('sede')) {
            $query->where('sede_id', $request->sede);
        }
        if ($request->filled('instructor')) {
            $query->where('instructor_id', $request->instructor);
        }
        if ($request->filled('grado')) {
            $query->where('grado', $request->grado);
        }

        // ordenamiento
        $sort = $request->get('sort', 'nombre');
        $direction = $request->get('direction', 'asc');
        $alumnos = $query->orderBy($sort, $direction)->get();

        $sedes = Sede::all();
        $instructores = Instructor::all();
        $grados = Alumno::select('grado')->distinct()->pluck('grado')->filter()->all();

        return view('alumnos.index', compact('alumnos', 'sedes', 'instructores', 'grados', 'sort', 'direction'));
    }

    public function create()
    {
        $sedes = Sede::all();
        $instructores = Instructor::all();
        return view('alumnos.create', compact('sedes', 'instructores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'rut' => 'required|string|unique:alumnos,rut',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'sede_id' => 'required|exists:sedes,id',
            'instructor_id' => 'required|exists:instructores,id',
            'grado' => 'nullable|string|max:255',
            'fecha_ultimo_examen' => 'nullable|date',
            'tiene_apoderado' => 'boolean',
        ]);

        Alumno::create($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno creado con éxito.');
    }

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        $sedes = Sede::all();
        $instructores = Instructor::all();
        $grados = Alumno::select('grado')->distinct()->pluck('grado')->filter()->all();

        return view('alumnos.edit', compact('alumno', 'sedes', 'instructores', 'grados'));
    }

    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|unique:alumnos,rut,' . $alumno->id,
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'sede_id' => 'required|exists:sedes,id',
            'instructor_id' => 'required|exists:instructores,id',
            'grado' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'fecha_ultimo_examen' => 'nullable|date',
            'tiene_apoderado' => 'boolean',
        ]);

        $alumno->update($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado con éxito.');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado con éxito.');
    }

    // 🚀 Exportar Excel
    public function export(Request $request)
    {
        $fileName = 'alumnos.xlsx';
        return Excel::download(new AlumnosExport($request), $fileName);
    }
}