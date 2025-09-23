@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-6">
    <div class="bg-gray-900 p-8 rounded-2xl shadow-2xl w-full max-w-2xl">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16">
        </div>
        <h2 class="text-2xl font-bold text-center text-white mb-6">Registrar Alumno</h2>

        <form action="{{ route('alumnos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-300">Nombre</label>
                <input type="text" name="nombre" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Apellido</label>
                <input type="text" name="apellido" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">RUT</label>
                <input type="text" name="rut" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Teléfono</label>
                <input type="text" name="telefono" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Dirección</label>
                <input type="text" name="direccion" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Sede</label>
                <select name="sede_id" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white">
                    <option value="">Seleccione una sede</option>
                    @foreach ($sedes as $sede)
                        <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Instructor</label>
                <select name="instructor_id" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white">
                    <option value="">Seleccione un instructor</option>
                    @foreach ($instructores as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->nombre }} {{ $instructor->apellido }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 🔹 Campo GRADO como lista desplegable -->
            <div>
                <label class="block text-sm font-medium text-gray-300">Grado</label>
                <select name="grado" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white">
                    <option value="">Seleccione un grado</option>
                    <option value="10 Blanco">10 Blanco</option>
                    <option value="9 Blanco Punta Amarilla">9 Blanco Punta Amarilla</option>
                    <option value="8 Amarillo">8 Amarillo</option>
                    <option value="7 Amarillo Punta Verde">7 Amarillo Punta Verde</option>
                    <option value="6 Verde">6 Verde</option>
                    <option value="5 Verde Punta Azul">5 Verde Punta Azul</option>
                    <option value="4 Azul">4 Azul</option>
                    <option value="3 Azul Punta Roja">3 Azul Punta Roja</option>
                    <option value="2 Rojo">2 Rojo</option>
                    <option value="1 Rojo Punta Negra">1 Rojo Punta Negra</option>
                    <option value="I Dan (Busabonim)">I Dan (Busabonim)</option>
                    <option value="II Dan (Busabonim)">II Dan (Busabonim)</option>
                    <option value="III Dan (Busabonim)">III Dan (Busabonim)</option>
                    <option value="IV Dan (Sabumnim)">IV Dan (Sabumnim)</option>
                    <option value="V Dan (Sabumnim)">V Dan (Sabumnim)</option>
                    <option value="VI Dan (Sabumnim)">VI Dan (Sabumnim)</option>
                    <option value="VII Dan (Sajiumnim)">VII Dan (Sajiumnim)</option>
                    <option value="VIII Dan (Sajiumnim)">VIII Dan (Sajiumnim)</option>
                    <option value="IX Dan (Sasumnim)">IX Dan (Sasumnim)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Fecha del Último Examen</label>
                <input type="date" name="fecha_ultimo_examen" class="mt-1 w-full rounded-lg border-gray-700 bg-gray-800 text-white">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="tiene_apoderado" value="1" class="mr-2">
                <span class="text-sm text-gray-300">¿Tiene apoderado?</span>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Guardar Alumno
            </button>
        </form>
    </div>
</div>
@endsection