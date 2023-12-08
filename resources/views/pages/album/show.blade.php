@extends('app')

@section('content')
    <h1>{{$album->titre}}</h1>
    <form action="{{route("albumFilterPhoto", "$album->id")}}" method="GET">
        <input type="text" name="titre" id="titre">
        <input type="text" name="tag" id="tag">
        <select name="order" id="order">
            <option value="titre">Titre</option>
            <option value="note">Note</option>
        </select>
        <select name="by" id="by" >
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
        <input type="submit">
    </form>
    @if (isset(Auth::user()->id) && Auth::user()->id == $album->user_id)
        <form action="{{route("albumDestroy", $album->id)}}" method="post">
            @csrf
            @method("delete")
            <input type="submit" value="Supprimer l'album">
        </form>
    @endif
    <ul>

        @forelse (isset($photoFilter) && $photoFilter ? $photo=$photoFilter : $photo=$album->photos as $p)
            <li>
                <div id="photoBig">
                    <div>
                        <img src="" alt="photo">
                        <button>Fermer</button>
                    </div>
                </div>
                <h2>{{$p->titre}}</h2>
                <img id="photoShow" src="{{$p->url}}" alt="{{$p->titre}}">
                <ul>
                    @foreach ($p->tags as $tag)
                        <li><a href="{{route("tagShow", $tag->id)}}">{{$tag->nom}}</a></li>
                    @endforeach
                </ul>
                <p>{{$p->note}}</p>
                    @if (isset(Auth::user()->id) && Auth::user()->id == $album->user_id)
                    <form action="{{route("photoDestroy", $p->id)}}" method="post">
                    @csrf
                    @method("delete")
                    <input type="submit" value="Supprimer">
                    </form>
                @endif
            </li>
        @empty
            <p>Aucune photo trouvée</p>
        @endforelse
    </ul>
        @if (isset(Auth::user()->id) && Auth::user()->id == $album->user_id)
        <form action="/photo" method="POST" id="add" enctype="multipart/form-data">
            @csrf
            <div class="input-fields">
                <div>
                    <input type="hidden" name="album_id" value="{{$album->id}}">
                    <input type="text" name="titre-photo[]" required placeholder="Titre">
                    <input type="file" name="image[]" required>
                    {{-- <input type="text" name="url[]" required placeholder="Lien de l'image"> --}}
                    <input type="number" name="note[]" min="0" max="10" required placeholder="Note">
                    <input type="text" name="tags[]" required placeholder="Les tags">
                    <button id="remove-photo">Supprimer la photo</button>
                </div>
            </div>
            <button id="add-photo">Ajouter une photo</button>
            @include("partials.errors")
            <input type="submit" value="Suivant">
        </form>
    @endif
    <a href="{{url()->previous()}}">Revenir en arrière</a>
    @endsection