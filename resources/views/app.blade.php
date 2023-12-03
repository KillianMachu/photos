<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/index.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="https://use.typekit.net/kjw8qrv.css">
    <title>Album Photo</title>
</head>
<body>
    <nav>
        <a href="{{route("home")}}">Home</a>
        <a href="{{route("albumIndex")}}">Les albums</a>
        <a href="{{route("tagIndex")}}">Catégories</a>
        @auth
            <h3>Bonjour {{Auth::user()->name}}</h3>
            <a href="{{route("logout")}}"
            onclick="document.getElementById('logout').submit(); return false;">Logout</a>
            <form id="logout" action="{{route("logout")}}" method="post">
                @csrf
            </form>
        @else
            <a href="{{route("login")}}">Login</a>
            <a href="{{route("register")}}">Register</a>
        @endauth
    </nav>
    <header>
        <nav class="navigation">
            <a href="{{route("albumIndex")}}">album</a>
            <a href="{{route("tagIndex")}}">tag</a>
             @auth
            <h3>Bonjour {{Auth::user()->name}}</h3>
            <a href="{{route("logout")}}"
            onclick="document.getElementById('logout').submit(); return false;">Logout</a>
            <form id="logout" action="{{route("logout")}}" method="post">
                @csrf
            </form>
        @else
            <a href="{{route("login")}}">connexion</a>
            @endauth
        </nav>
        <div class="buthead">
            <h1>ARTLENS TON ALBUM <br>PARTOUT AVEC TOI</h1>
        </div>
    </header>
    <main>
    @yield('content')
    </main>
    <footer>
        <div id="information">
            <h3>Informations</h3>
            <ul>
                <li>Contact</li>
                <li>Mentions Légales</li>
                <li>Réseaux sociaux</li>
            </ul>
        </div>
        <div id="newsletter">
            <h3>News letter</h3>
            <form action="" method="" class="news-letter">
                <input type="text" name="mail-news" id="mail-news" placeholder="Adresse Mail">
                <button>Envoyer</button>
            </form>
        </div>
    </footer>
</body>
</html>
