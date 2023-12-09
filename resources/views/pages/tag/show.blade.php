@extends('app')

@section('content')

<h1 class="titre">{{$tag->nom}}</h1>
<ul class="photo-album">
    @foreach($tag->photos as $p)
    <a href="{{route('albumShow', $p->album->id)}}"><img src="{{$p->url}}" alt="{{$p->titre}}" ></a>
    @endforeach
    <a href="{{url()->previous()}}" class="return">Revenir en arrière</a>
</ul>

@endsection