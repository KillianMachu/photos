@extends('app')

@section('content')
    <h1 class="titre">Voici la liste des albums</h1>
<div class="album-show">
    <form action="{{route("albumIndex")}}" method="GET" class="order-album">
        <select name="order" id="order" class="two-select menue1">
            <option value="titre">Titre</option>
            <option value="created_at">Date de création</option>
        </select>
        <select name="by" id="by" class="two-select menue2">
            <option value="asc">Croissant</option>
            <option value="desc"">Décroissant</option> 
        </select>
        <input type="submit" value="Trier" class="order-submit">
    </form>
    <form action="{{route("albumSort")}}" method="GET" class="search-album">
        <input type="search" name="search" id="search" value="{{request()->get('search')}}" placeholder="Rechercher" class="input1">
        <input type="submit" value="envoyer" class="seach-button">
    </form>
</div>

    <ul class="flex-show">
        @foreach ($albums as $a)
            <li><a href="{{route('albumShow', $a->id)}}" class="show"> <h3>{{$a->titre}}</h3>
            <img src="/image/cyberpunk.jpeg" alt="">
            <div class="tag-album">
            <span>#cyberpunk</span>
            <span>#futur</span>
        </div>
        </a></li>            
        @endforeach
        
    </ul>
@endsection