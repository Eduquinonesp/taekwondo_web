@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-100">Listado de Alumnos</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filtros + Exportar --}}
    <div class="bg-slate-900/90 border border-slate-800 rounded-xl shadow-lg p-4 md:p-5 mb-6">
        <form method="GET" action="{{ route('alumnos.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            {{-- Sede --}}
            <div class="md:col-span-3">
                <label for="sede" class="block text-sm text-slate-300 mb-1">Sede</label>
                <select
                    id="sede"
                    name="sede"
                    class="block w-full rounded-lg bg-slate-800 border border-slate-700 text-slate-100 placeholder-slate-400 px-3 py-2
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" class="bg-slate-800 text-slate-100">Todas</option>
                    @foreach($sedes as $sede)
                        <option
                            value="{{ $sede->id }}"
                            @selected(request('sede') == $sede->id)
                            class="bg-slate-800 text-slate-100">
                            {{ $sede->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Instructor --}}
            <div class="md:col-span-3">
                <label for="instructor" class="block text-sm text-slate-300 mb-1">Instructor</label>
                <select
                    id="instructor"
                    name="instructor"
                    class="block w-full rounded-lg bg-slate-800 border border-slate-700 text-slate-100 placeholder-slate-400 px-3 py-2
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" class="bg-slate-800 text-slate-100">Todos</option>
                    @foreach($instructores as $inst)
                        <option
                            value="{{ $inst->id }}"
                            @selected(request('instructor') == $inst->id)
                            class="bg-slate-800 text-slate-100">
                            {{ $inst->nombre }} {{ $inst->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Grado (combo) --}}
            <div class="md:col-span-3">
                <label for="grado" class="block text-sm text-slate-300 mb-1">Grado</label>
                <select
                    id="grado"
                    name="grado"
                    class="block w-full rounded-lg bg-slate-800 border border-slate-700 text-slate-100 placeholder-slate-400 px-3 py-2
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" class="bg-slate-800 text-slate-100">Todos</option>
                    @foreach($grados as $g)
                        <option
                            value="{{ $g }}"
                            @selected(request('grado') == $g)
                            class="bg-slate-800 text-slate-100">
                            {{ $g }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Acciones filtros --}}
            <div class="md:col-span-3 flex gap-3 md:justify-end">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 transition">
                    Filtrar
                </button>

                {{-- Exportar conserva filtros actuales vía query string --}}
                <a
                    href="{{ route('alumnos.export', request()->query()) }}"
                    class="inline-flex items-center justify-center rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 transition">
                    Exportar Excel
                </a>
            </div>
        </form>
    </div>

    {{-- Tabla --}}
    <div class="bg-slate-900 shadow-md rounded-lg overflow-hidden border border-slate-800">
        <table class="min-w-full table-auto">
            <thead class="bg-slate-800 text-slate-300">
                <tr>
                    @php
                        $columns = [
                            'nombre'               => 'Nombre',
                            'apellido'             => 'Apellido',
                            'rut'                  => 'RUT',
                            'sede_id'              => 'Sede',
                            'instructor_id'        => 'Instructor',
                            'grado'                => 'Grado',
                            'fecha_nacimiento'     => 'Edad',
                            'fecha_ultimo_examen'  => 'Días desde examen',
                        ];
                        $dir = request('direction', 'asc');
                    @endphp

                    @foreach ($columns as $col => $label)
                        <th class="px-6 py-3 text-left">
                            <a
                                href="{{ route('alumnos.index', array_merge(request()->query(), [
                                    'sort' => $col,
                                    'direction' => (request('sort') === $col && $dir === 'asc') ? 'desc' : 'asc'
                                ])) }}"
                                class="flex items-center gap-1 hover:underline">
                                <span>{{ $label }}</span>
                                @if(request('sort') === $col)
                                    <span class="text-slate-400">{{ $dir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                    @endforeach

                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="text-slate-200">
                @forelse ($alumnos as $alumno)
                    <tr class="border-b border-slate-800/70 hover:bg-slate-800/70">
                        <td class="px-6 py-4">{{ $alumno->nombre }}</td>
                        <td class="px-6 py-4">{{ $alumno->apellido }}</td>
                        <td class="px-6 py-4">{{ $alumno->rut }}</td>
                        <td class="px-6 py-4">{{ $alumno->sede->nombre ?? '-' }}</td>
                        <td class="px-6 py-4">
                            {{ $alumno->instructor ? $alumno->instructor->nombre.' '.$alumno->instructor->apellido : '-' }}
                        </td>
                        <td class="px-6 py-4">{{ $alumno->grado ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $alumno->edad }} años</td>
                        <td class="px-6 py-4">
                            @if($alumno->dias_desde_ultimo_examen)
                                @php
                                    $total = (int) $alumno->dias_desde_ultimo_examen;
                                    $anos  = intdiv($total, 365);
                                    $resto = $total % 365;
                                    $meses = intdiv($resto, 30);
                                    $dias  = $resto % 30;
                                @endphp
                                {{ $anos > 0 ? "$anos años, " : '' }}{{ $meses }} meses y {{ $dias }} días
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('alumnos.edit', $alumno->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                    Editar
                                </a>
                                <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este alumno?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-6 text-center text-slate-400">
                            No hay alumnos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection