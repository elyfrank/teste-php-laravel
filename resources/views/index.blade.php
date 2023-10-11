<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <title>Teste PHP Laravel</title>
</head>
<body>
<header>
    <nav>
        <ul class="main-menu">
            <li><a href="#">Página de Importação</a></li>
            <li><a href="{{ route('queue') }}">Página de Processamento</a></li>
        </ul>
    </nav>
</header>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<form method="POST" action="{{ route('upload-file') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".json">
    <button type="submit">Enviar Arquivo</button>
</form>
</body>
</html>
