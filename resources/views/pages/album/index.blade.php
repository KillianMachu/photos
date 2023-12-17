@extends('app')

@section('content')
    <div class="albumIndex">
        <div class="discover">
            <div class="container">
                @if (isset($result))
                    @if (count($albums)==1)
                        <h2>Résultat de la recherche : "{{$result}}"</h2>
                    @else
                        <h2>Résultats de la recherche : "{{$result}}"</h2>
                    @endif
                @else
                    <h2>Découvre les albums !</h2>
                @endif
                <div>
                    @if (count($albums)>0)
                        @for ($i = 0; $i < count($albums); $i++)
                            <div>
                                <div class="img_alb_welcome">
                                    @if(isset($photos[$i]))
                                        <img src="{{$photos[$i]->url}}" alt="{{$photos[$i]->titre}}">
                                    @else
                                        <img style="object-fit: contain" src="/images/vectors/empty.svg" alt="empty">
                                    @endif
                                </div>
                                <div class="desc_alb_welcome">
                                    <h3>{{$albums[$i]->titre}}</h3>
                                    @if ($users[$i])
                                        <h4>Créé par <i>{{$users[$i]}}</i>, le <i>{{date('j F Y', strtotime($albums[$i]->creation))}}</i></h4>
                                    @else
                                        <h4>Créé le <i>{{date('j F Y', strtotime($albums[$i]->creation))}}</i></h4>
                                    @endif
                                    <div>
                                        <a href="{{route("albumShow", $albums[$i]->id)}}" class="button visit"><span>Parcourir l'album</span></a>
                                        @if (isset(Auth::user()->id) && Auth::user()->id == $albums[$i]->user_id)
                                            <form action="{{route("albumDestroy", $albums[$i]->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <a href="#" onclick="document.getElementById('alb_delete_welcome').click()" class="button delete"><span>Supprimer l'album</span></a>
                                                <input type="submit" value="Supprimer l'album" id="alb_delete_welcome">
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endfor 
                    @else
                        <p class="empty">Oups, il semblerait qu'aucun album n'ait était créé. Soit le premier à en créer un !</p>
                        <img class="empty" src="/images/vectors/empty.svg" alt="empty">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection