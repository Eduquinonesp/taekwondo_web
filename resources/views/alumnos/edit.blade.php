@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-900">
    <div class="w-full max-w-2xl bg-gray-800 p-8 rounded-lg shadow-lg">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Taekwon-Do" class="h-20">
        </div>

        <h2 class="text-2xl font-bold text-center text-white mb-6">Editar Alumno</h2>

        <form method="POST" action="{{ route('alumnos.update', $alumno->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <!-- Nombre -->
                <div>
                    <label class="block text-gray-300">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $alumno->nombre) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- Apellido -->
                <div>
                    <label class="block text-gray-300">Apellido</label>
                    <input type="text" name="apellido" value="{{ old('apellido', $alumno->apellido) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- Fecha de Nacimiento -->
                <div>
                    <label class="block text-gray-300">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- RUT -->
                <div>
                    <label class="block text-gray-300">RUT</label>
                    <input type="text" name="rut" value="{{ old('rut', $alumno->rut) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- Teléfono -->
                <div>
                    <label class="block text-gray-300">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $alumno->telefono) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ old('email', $alumno->email) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- Dirección -->
                <div class="col-span-2">
                    <label class="block text-gray-300">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $alumno->direccion) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- Sede -->
                <div>
                    <label class="block text-gray-300">Sede</label>
                    <select name="sede_id"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                        <option value="">Seleccione una sede</option>
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}" {{ $alumno->sede_id == $sede->id ? 'selected' : '' }}>
                                {{ $sede->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Instructor -->
                <div>
                    <label class="block text-gray-300">Instructor</label>
                    <select name="instructor_id"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                        <option value="">Seleccione un instructor</option>
                        @foreach($instructores as $instructor)
                            <option value="{{ $instructor->id }}" {{ $alumno->instructor_id == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Grado -->
                <div class="col-span-2">
                    <label class="block text-gray-300">Grado</label>
                    <select name="grado"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                        <option value="">Seleccione un grado</option>
                        <option value="10 Blanco" {{ $alumno->grado == '10 Blanco' ? 'selected' : '' }}>10 Blanco</option>
                        <option value="9 Blanco Punta Amarilla" {{ $alumno->grado == '9 Blanco Punta Amarilla' ? 'selected' : '' }}>9 Blanco Punta Amarilla</option>
                        <option value="8 Amarillo" {{ $alumno->grado == '8 Amarillo' ? 'selected' : '' }}>8 Amarillo</option>
                        <option value="7 Amarillo Punta Verde" {{ $alumno->grado == '7 Amarillo Punta Verde' ? 'selected' : '' }}>7 Amarillo Punta Verde</option>
                        <option value="6 Verde" {{ $alumno->grado == '6 Verde' ? 'selected' : '' }}>6 Verde</option>
                        <option value="5 Verde Punta Azul" {{ $alumno->grado == '5 Verde Punta Azul' ? 'selected' : '' }}>5 Verde Punta Azul</option>
                        <option value="4 Azul" {{ $alumno->grado == '4 Azul' ? 'selected' : '' }}>4 Azul</option>
                        <option value="3 Azul Punta Roja" {{ $alumno->grado == '3 Azul Punta Roja' ? 'selected' : '' }}>3 Azul Punta Roja</option>
                        <option value="2 Rojo" {{ $alumno->grado == '2 Rojo' ? 'selected' : '' }}>2 Rojo</option>
                        <option value="1 Rojo Punta Negra" {{ $alumno->grado == '1 Rojo Punta Negra' ? 'selected' : '' }}>1 Rojo Punta Negra</option>
                        <option value="I Dan (Busabonim)" {{ $alumno->grado == 'I Dan (Busabonim)' ? 'selected' : '' }}>I Dan (Busabonim)</option>
                        <option value="II Dan (Busabonim)" {{ $alumno->grado == 'II Dan (Busabonim)' ? 'selected' : '' }}>II Dan (Busabonim)</option>
                        <option value="III Dan (Busabonim)" {{ $alumno->grado == 'III Dan (Busabonim)' ? 'selected' : '' }}>III Dan (Busabonim)</option>
                        <option value="IV Dan (Sabumnim)" {{ $alumno->grado == 'IV Dan (Sabumnim)' ? 'selected' : '' }}>IV Dan (Sabumnim)</option>
                        <option value="V Dan (Sabumnim)" {{ $alumno->grado == 'V Dan (Sabumnim)' ? 'selected' : '' }}>V Dan (Sabumnim)</option>
                        <option value="VI Dan (Sabumnim)" {{ $alumno->grado == 'VI Dan (Sabumnim)' ? 'selected' : '' }}>VI Dan (Sabumnim)</option>
                        <option value="VII Dan (Sajiumnim)" {{ $alumno->grado == 'VII Dan (Sajiumnim)' ? 'selected' : '' }}>VII Dan (Sajiumnim)</option>
                        <option value="VIII Dan (Sajiumnim)" {{ $alumno->grado == 'VIII Dan (Sajiumnim)' ? 'selected' : '' }}>VIII Dan (Sajiumnim)</option>
                        <option value="IX Dan (Sasumnim)" {{ $alumno->grado == 'IX Dan (Sasumnim)' ? 'selected' : '' }}>IX Dan (Sasumnim)</option>
                    </select>
                </div>

                <!-- Fecha del Último Examen -->
                <div class="col-span-2">
                    <label class="block text-gray-300">Fecha del Último Examen</label>
                    <input type="date" name="fecha_ultimo_examen" value="{{ old('fecha_ultimo_examen', $alumno->fecha_ultimo_examen) }}"
                        class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring focus:ring-blue-500">
                </div>

                <!-- Apoderado -->
                <div class="col-span-2">
                    <label class="flex items-center text-gray-300">
                        <input type="checkbox" name="tiene_apoderado" value="1" {{ $alumno->tiene_apoderado ? 'checked' : '' }}
                            class="mr-2 rounded">
                        ¿Tiene Apoderado?
                    </label>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Actualizar Alumno
                </button>
            </div>
        </form>
    </div>
</div>
@endsection