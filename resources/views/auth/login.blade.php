@extends('app')

@section('content')

<div id="auth">
    <div class="auth2">
        <div>
            <h3>Coucou! Nous sommes heureux de te revoir</h3>
        </div>
        <div>
            <form action="{{route("login")}}" method="post">
                @csrf
                <input type="email" name="email" required placeholder="Email" /><br />
                <input type="password" name="password" required placeholder="Mot de passe" /><br />
                Se souvenir de moi<input type="checkbox" name="remember" id="case"/><br />
                <input type="submit" id="bouton" placeholder="Connexion"/><br />
            </form>
            <p>Pas de compte? </br> <a href="{{route("register")}}">Inscrit toi!</a></p>
        </div>
    </div>
</div>

@endsection
