<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Styles / Scripts -->

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            @auth()
            <span class="badge bg-light text-dark rounded shadow">{{auth()->user()->name}}</span>
            @endauth
            
            @if(session()->has("success"))
            <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif

            <form action="{{route('login')}}" method="post" class="mt-5 shadow p-2 rounded border">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" placeholder="Ex: *****">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{route('oauth-redirect',['oauth'=>'github'])}}" class="btn btn-dark">Github</a>
                    <a href="{{route('oauth-redirect',['oauth'=>'google'])}}" class="btn btn-dark mx-1">Google</a>
                    <a href="{{route('oauth-redirect',['oauth'=>'facebook'])}}" class="btn btn-dark">Facebook</a>
                </div>
            </form>
        </div>
    </div>

    @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>