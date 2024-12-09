<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("titre")</title>
    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{route('annonce.index')}}">Annonce App</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{Route::is('accueil')?'active': ''}}" href="{{route('annonce.index')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('accueil')?'active': ''}}" href="{{route('annonce.create')}}">Nouvelle annonce</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        @yield("contenu")
    </div>
    <script src="{{asset('bootstrap/bootstrap.min.js')}}"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
</body>

</html>