@extends('app')

@section('content')

<div id="auth">
    <div class="auth2">
        <div>
            <p>Ne t'inquiète pas, nous ne partageons pas tes données!</p>
        </div>
        <div>
            <form action="{{route("register")}}" method="post">
                @csrf
                <input type="text" name="name" required placeholder="Name" /><br />
                <input type="email" name="email" required placeholder="Email" /><br />
                <input type="password" name="password" required placeholder="password" /><br />
                <input type="password" name="password_confirmation" required placeholder="password" /><br />
                @include('partials.errors')
                <input type="submit" /><br />
            </form>
            Déjà un compte  ?</br> <a href="{{route("login")}}">Connectez vous !</a>
        </div>
    </div>
</div>
@endsection
