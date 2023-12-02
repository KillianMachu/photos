@extends('app')

@section('content')
    <h1>Voici la liste des albums</h1>
    <form action="{{route("albumFilter")}}" method="POST">
        @csrf
        <input type="search" name="search" id="search">
        <input type="submit" value="Rechercher">
    </form>
    <a href="{{route("albumIndex", "titre/asc")}}">Titre croissant</a>
    <a href="{{route("albumIndex", "titre/desc")}}">Titre décroissant</a>
    <a href="{{route("albumIndex", "created_at/asc")}}">Date de création croissant</a>
    <a href="{{route("albumIndex", "created_at/desc")}}">Date de création décroissant</a>

    <ul>
        @foreach ($albums as $a)
            <li><a href="{{route('albumShow', $a->id)}}">{{$a->titre}}</a></li>            
        @endforeach
        
    </ul>
@endsection