@extends('app')

@section('content')
    <h1>Voici la liste des albums</h1>
    <form action="{{route("albumFilter")}}" method="GET">
        <input type="search" name="search" id="search" value="{{request()->get('search')}}">
        <input type="submit" value="Rechercher">
    </form>
    <form action="{{route("albumIndex")}}" method="GET">
        <select name="order" id="order">
            <option value="titre">Titre</option>
            <option value="created_at">Date de création</option>
        </select>
        <select name="by" id="by" >
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
        <input type="submit" value="Trier">
    </form>

    <ul>
        @foreach ($albums as $a)
            <li><a href="{{route('albumShow', $a->id)}}">{{$a->titre}}</a></li>            
        @endforeach
        
    </ul>
@endsection