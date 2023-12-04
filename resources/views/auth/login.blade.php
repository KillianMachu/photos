@extends('app')

@section('content')

<div id="auth">
    <div class="auth2">
        <div>
            <p>Coucou! Nous sommes heureux de te revoir</p>
        </div>
        <div>
            <form action="{{route("login")}}" method="post">
                @csrf
                <input type="email" name="email" required placeholder="Email" /><br />
                <input type="password" name="password" required placeholder="password" /><br />
                Remember me<input type="checkbox" name="remember"   /><br />
                <input type="submit" /><br />
            </form>
            Pas de compte? </br> <a href="{{route("register")}}">Inscrit toi!</a>
        </div>
    </div>
</div>

@endsection
