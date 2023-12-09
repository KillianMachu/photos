@extends('app')

@section('content')

<h1 class="titre">Créer un nouvel album</h1>
<div class="center">
<form action="{{route('albumStore')}}" method="post" id="add" enctype="multipart/form-data" class="form-create">
    @csrf
    <div class="create-container">
    <div class="input-fields">
        <label for="titre"></label>
        <input type="text" name="titre" id="titre" placeholder="Titre de votre album" required class="menue">
    </div>
    <button id="add-photo" class="menue">Ajouter une photo</button >
    @include("partials.errors")
    <input type="submit" value="Suivant" class="submite">
</div>
</form>
</div>

@endsection