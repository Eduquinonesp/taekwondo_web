<!-- resources/views/alumnos/index.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Listado de Alumnos</h1>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>RUT</th>
                <th>Fecha Nacimiento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Sede</th>
                <th>Instructor</th>
                <th>Fecha Último Examen</th>
                <th>Apoderado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->apellido }}</td>
                    <td>{{ $alumno->rut }}</td>
                    <td>{{ $alumno->fecha_nacimiento }}</td>
                    <td>{{ $alumno->telefono }}</td>
                    <td>{{ $alumno->email }}</td>
                    <td>{{ $alumno->sede->nombre ?? 'No asignada' }}</td>
                    <td>{{ $alumno->instructor->nombre ?? 'No asignado' }}</td>
                    <td>{{ $alumno->fecha_ultimo_examen ?? 'No registra' }}</td>
                    <td>{{ $alumno->tiene_apoderado ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
