<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager || {{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        .sprite svg {
            width: 1rem;
            height: 1.1rem;
            cursor: all-scroll;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <a class="nav-link @if($current == 'tasks-list') active @endif" href="{{ route('tasks.index') }}">Tasks</a>
                <a class="nav-link @if($current == 'projects-list') active @endif" href="{{ route('projects.index') }}">Projects</a>
              </div>
            </div>
        </nav>
        
        <div class="section mt-3">
            @yield('main')
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/function.js') }}"></script>

    @yield('script')
</body>
</html>