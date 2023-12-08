@extends('app')

@section('content')
    <h1 class="titre">{{$album->titre}}</h1>
    <div class="album-div-flex">
    <form action="{{route("albumFilterPhoto", "$album->id")}}" method="GET" class="form-albm">
      
        <select name="order" id="order">
            <option value="titre">Titre</option>
            <option value="note">Note</option>
        </select>
        <select name="by" id="by" >
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
        <input type="text" name="titre" id="titre" placeholder="titre">
        <input type="text" name="tag" id="tag" placeholder="tag">
        <input type="submit" class="submit">
    </form>
</div>
    @if (isset(Auth::user()->id) && Auth::user()->id == $album->user_id)
        <form action="{{route("albumDestroy", $album->id)}}" method="post">
            @csrf
            @method("delete")
            <input type="submit" value="Supprimer l'album">
        </form>
    @endif
    <ul class="photo-album">

        @forelse (isset($photoFilter) && $photoFilter ? $photo=$photoFilter : $photo=$album->photos as $p)
            <li>
                <div id="photoBig">
                    <div>
                        <img src="" alt="photo">
                        <button>Fermer</button>
                    </div>
                </div>
            
                <h2 class="titre2">{{$p->titre}}</h2 >
                <img id="photoShow" src="{{$p->url}}" alt="{{$p->titre}}">
                <ul>
                    @foreach ($p->tags as $tag)
                        <li><a href="{{route("tagShow", $tag->id)}}" class="album-tag-show">{{$tag->nom}}</a></li>
                    @endforeach
                </ul>
                <p>{{$p->note}}/5</p>


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
        <div class="center">
        <form action="/photo" method="POST" id="add" enctype="multipart/form-data" class="form-create">
            @csrf
            <div class="input-fields">
                <div class="create-container">
                    <input type="hidden" name="album_id" value="{{$album->id}}" class="menue">
                    <input type="text" name="titre-photo[]" required placeholder="Titre"class="menue">
                    <input type="file" name="image[]" requiredclass="menue">
                    {{-- <input type="text" name="url[]" required placeholder="Lien de l'image"> --}}
                    <input type="number" name="note[]" min="0" max="10" required placeholder="Note"class="menue">
                    <input type="text" name="tags[]" required placeholder="Les tags"class="menue">
                    <button id="remove-photo">Supprimer la photo</button>
                </div>
            </div>
            <button id="add-photo">Ajouter une photo</button>
            @include("partials.errors")
            <input type="submit" value="Suivant">
        </form>
    </div>
    @endif
    <a href="{{url()->previous()}}" class="return">Revenir en arrière</a>
    @endsection