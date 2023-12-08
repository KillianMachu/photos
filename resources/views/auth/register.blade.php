@extends('app')

@section('content')

<div id="auth">
    <div class="auth2">
        <div>
            <h3>Ne t'inquiète pas, nous ne partageons pas tes données!</h3>
        </div>
        <div>
            <form action="{{route("register")}}" method="post">
                @csrf
                <input type="text" name="name" required placeholder="Nom   " /><br />
                <input type="email" name="email" required placeholder="Email" /><br />
                <input type="password" name="password" required placeholder="Mot de passe" /><br />
                <input type="password" name="password_confirmation" required placeholder="Mot de passe" /><br />
                @if ($errors)
                @error('email')
                    <p>{{$message}}</p>
                @enderror
                @error('password')
                    <p>{{$message}}</p>
                @enderror
                @endif
                <input type="submit" id="bouton"/><br />
            </form>
           <p>Déjà un compte  ?</br> <a href="{{route("login")}}">Connectez vous !</a></p>
        </div>
    </div>
</div>
@endsection
