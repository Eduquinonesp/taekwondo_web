<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Taekwon-Do')</title>
    
    <!-- Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<script>
    // Ocultar alertas después de 4 segundos
    setTimeout(() => {
        document.querySelectorAll('.fixed.top-4.right-4').forEach(el => {
            el.style.transition = "opacity 0.5s ease";
            el.style.opacity = "0";
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);
</script>

<body class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-lg font-semibold">Ki-Store | Taekwon-Do</h1>
            <div class="space-x-4">
                <a href="{{ route('alumnos.index') }}" class="text-white hover:underline">Alumnos</a>
                <a href="{{ route('alumnos.create') }}" class="text-white hover:underline">Registrar</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="py-10">
        @yield('content')
        @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce">
        ✅ {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="fixed top-4 right-4 bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        ❌ Hubo un error al procesar tu solicitud.
        <ul class="mt-2 text-sm">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </main>
</body>
</html>
