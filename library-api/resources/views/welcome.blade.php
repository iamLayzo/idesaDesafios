<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library API - Jesus Baez</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: Figtree, sans-serif;
            background-color: #f3f4f6;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='none'%3E%3Cpath fill='rgba(0,0,0,0.07)' d='M1.5 0C2.33 0 3 .67 3 1.5S2.33 3 1.5 3 0 2.33 0 1.5.67 0 1.5 0z'/%3E%3C/svg%3E");
            background-position: center;
            background-size: auto;
            background-repeat: repeat;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            color: #333;
        }
        p {
            font-size: 1.125rem;
            color: #555;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #e5e7eb;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Library API - Jesús Báez</h1>
        <p>Bienvenido a la API de Library. Explora la documentación y funcionalidades.</p>
    </div>
    <footer>
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</body>
</html>
