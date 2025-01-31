<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Blog')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 me-3 text-white text-decoration-none">
                    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo-white.svg" alt="Logo" width="40" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/" class="nav-link px-2 {{ request()->is('/') ? 'text-secondary' : 'text-white' }}">Início</a></li>
                    <li><a href="{{ route('artigos.index') }}" class="nav-link px-2 {{ request()->is('artigos*') ? 'text-secondary' : 'text-white' }}">Artigos</a></li>
                    <li><a href="{{ route('categorias.index') }}" class="nav-link px-2 {{ request()->is('categorias*') ? 'text-secondary' : 'text-white' }}">Categorias</a></li>
                </ul>

                <div class="text-end">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light rounded-pill me-2">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light rounded-pill me-2">Registrar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
