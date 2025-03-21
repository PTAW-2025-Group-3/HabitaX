<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>HabitaX</title>
</head>
<body>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>

    <h1 class="text-3xl font-bold text-blue-600">Testando jQuery no Laravel </h1>

    <!-- Parágrafo que será ocultado/mostrado -->
    <p id="mensagem" class="text-gray-700 mt-4">Este texto pode ser ocultado ou mostrado com jQuery!</p>

    <!-- Botão para alternar a visibilidade -->
    <button id="toggle-btn" class="px-4 py-2 bg-blue-500 text-white rounded mt-4">
        Mostrar/Ocultar Texto
    </button>

    <!-- Script jQuery -->
    <script>

    </script>


</body>
</html>
