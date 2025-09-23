<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Sistema Taekwon-Do</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-gray-800 rounded-2xl p-8 shadow-2xl">
        
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Taekwon-Do" class="h-20 w-auto">
        </div>

        <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Correo electrónico</label>
                <input id="email" type="email" name="email" required
                    class="w-full rounded-md bg-gray-700 border border-gray-600 p-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full rounded-md bg-gray-700 border border-gray-600 p-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Botón -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">
                    Ingresar
                </button>
            </div>
        </form>

        <div class="text-center text-sm text-gray-400 mt-4">
            ¿Olvidaste tu contraseña?
            <a href="{{ route('password.request') }}" class="text-blue-400 hover:underline">Recupérala aquí</a>
        </div>
    </div>

</body>
</html>
