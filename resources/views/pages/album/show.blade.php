@extends('app')

@section('content')

<div class="container albumShow">
    @if (request()->input("titre") && !request()->input("tag"))
        <h2>Résultat de la recherche pour le titre : "{{request()->input("titre")}}", dans l'album {{$album->titre}}</h2>
    @elseIf (request()->input("tag") && !request()->input("titre"))
        <h2>Résultat de la recherche pour le tag : "{{request()->input("tag")}}", dans l'album {{$album->titre}}</h2>
    @elseIf (request()->input("tag") && request()->input("titre"))
        <h2>Résultat de la recherche pour le titre : "{{request()->input("titre")}}" et le tag : "{{request()->input("tag")}}", dans l'album {{$album->titre}}</h2>
    @else
        <h2>{{$album->titre}}</h2>
    @endif
    <div class="photoFilter">
        <form action="{{route("albumFilterPhoto", "$album->id")}}" method="GET" class="form-albm">
            <select name="order" id="order">
                <option value="" disabled selected hidden>Trier selon ...</option>
                <option value="titre" {{(request()->get('order')=="titre" ? "selected" : false)}}>Titre</option>
                <option value="note" {{(request()->get('order')=="note" ? "selected" : false)}}>Note</option>
            </select>
            <select name="by" id="by" >
                <option value="" disabled selected hidden>Par ordre ...</option>
                <option value="asc" {{(request()->get('by')=="asc" ? "selected" : false)}}>Croissant</option>
                <option value="desc" {{(request()->get('by')=="desc" ? "selected" : false)}}>Décroissant</option>
            </select>
            <input type="text" name="titre" id="titre" placeholder="titre" value="{{request()->get('titre')}}">
            <input type="text" name="tag" id="tag" placeholder="tag", value="{{request()->get('tag')}}">
            <input type="submit" class="submit" value="Filtrer">
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
                                <input type="submit" value="Supprimer la photo" id="photo_delete{{$p->id}}" class="photo_delete">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            
        @empty
        <div class="empty-zone">
            @if (request()->input("titre")||request()->input("tag"))
                <p class="empty">Aucun album correspondant à la recherche</p>
                <img class="empty" src="/images/vectors/empty.svg" alt="empty">
            @else
                <p class="empty">Oups, il semblerait qu'aucun album n'ait était créé. Sois le premier à en créer un !</p>
                <img class="empty" src="/images/vectors/empty.svg" alt="empty">
            @endif
        </div>
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