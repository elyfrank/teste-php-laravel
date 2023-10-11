<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <title>Teste PHP Laravel - Processamento</title>
</head>
<body>
<header>
    <nav>
        <ul class="main-menu">
            <li><a href="{{ route('index') }}">Página de Importação</a></li>
            <li><a href="#">Página de Processamento</a></li>
        </ul>
    </nav>
</header>
@if (session('success-job'))
    <div class="alert alert-success">
        {{ session('success-job') }}
    </div>
@endif
<form method="post" action="/queue-work">
    @csrf
    <button type="submit">Iniciar processamento da fila</button>
</form>
</body>
</html>