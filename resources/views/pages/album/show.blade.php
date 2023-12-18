@extends('app')

@section('content')

<div class="container albumShow">
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
    @auth
        @if (Auth::user()->id == $album->user_id)
            <form action="{{route("albumDestroy", $album->id)}}" method="post">
                @csrf
                @method("delete")
                <input type="submit" value="Supprimer l'album">
            </form>
        @endif
    @endauth

    <div id="photoBig">
        <div>
            <img src="" alt="photo">
        </div>
        <button><i class='bx bx-x' ></i></button>
    </div>

    <div class="photos">
            @forelse (isset($photoFilter) && $photoFilter ? $photo=$photoFilter : $photo=$album->photos as $p)
                <div>
                    <div class="img_photo">
                        <i class='bx bx-expand'></i>
                        <img id="photoShow" src="{{$p->url}}" alt="{{$p->titre}}">
                    </div>
                    <div class="desc_photo">
                        <h3>{{$p->titre}}</h3>
                        {{-- @if ($users[$i])
                            <h4>Créé par <i>{{$users[$i]}}</i>, le <i>{{date('j F Y', strtotime($albums[$i]->creation))}}</i></h4>
                        @else --}}
                        <h4>Importée le <i>{{date('j F Y', strtotime($p->created_at))}}</i></h4>
                        <div class="tags">
                            <i class='bx bxs-purchase-tag'></i>
                            @foreach ($p->tags as $tag)
                                <a href="{{route("tagShow", $tag->id)}}" class="album-tag-show">{{$tag->nom}}</a>
                            @endforeach
                        </div>
                        <p>Note : <b>{{$p->note}}/5</b></p>
                        <div class="buttons">
                            @if (isset(Auth::user()->id) && Auth::user()->id == $album->user_id)
                                <form action="{{route("photoDestroy", $p->id)}}" method="post">
                                    @csrf
                                    @method("delete")
                                    <a href="#" onclick="document.getElementById('photo_delete{{$p->id}}').click()" class="button delete"><span><i class='bx bxs-trash' ></i>Supprimer la photo</span></a>
                                    <input type="submit" value="Supprimer la photo" id="photo_delete{{$p->id}}">
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                
            @empty
            <p>aucune photo trouvée</p>
            @endforelse
</div>


    </ul>
        @if (isset(Auth::user()->id) && Auth::user()->id == $album->user_id)
        <div class="center">
        <form action="/photo" method="POST" id="add" enctype="multipart/form-data" class="form-create">
            @csrf
            <div class="create-container">
                <div class="input-fields">
                    <input type="hidden" name="album_id" value="{{$album->id}}" class="menue">
                    <input type="text" name="titre-photo[]" required placeholder="Titre"class="menue">
                    <input type="file" name="image[]" requiredclass="menue">
                    {{-- <input type="text" name="url[]" required placeholder="Lien de l'image"> --}}
                    <input type="number" name="note[]" min="0" max="5" required placeholder="Note"class="menue">
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
    <a href="{{url()->previous()}}" class="return"><i class='bx bxs-chevron-left' ></i><span>Retour</span></a>
    @endsection