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
            <a href="">album</a>
            <a href="">tag</a>
            <a href="">connexion</a>
        </nav>
        <div class="buthead">
            <a href="">CREE TON ALBUM<br>AVEC ARTLENS</a>
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
