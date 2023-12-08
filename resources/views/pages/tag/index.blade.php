@extends('app')

@section('content')

<h1  class="titre">Voici la liste des tags</h1>
<ul class="tag-show">
    @foreach($tags as $t)
    <li><a href="{{route("tagShow",$t->id)}}">{{$t->nom}}</a></li>
    @endforeach
</ul>

@endsection