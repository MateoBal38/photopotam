@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailAlbum.css') }}">
@endpush

@section('content')

<div class="container">

<form method="GET" action="{{ route('album.show', $id) }}">

    @csrf

    <input name="search" type="text" placeholder="Rechercher une photo" required></input>

    <input name="button" type="submit" placeholder="Rechercher"></input>

    <select name="tags[]" multiple>
        @foreach($liste_tags as $tag)
            <option value="{{ $tag->nom }}"
                @if(is_array(request('tags')) && in_array($tag->nom, request('tags'))) selected @endif>   
                {{ $tag->nom }}
            </option>
        @endforeach
    </select>

</form>



@auth 
    @if(Auth::id() == $album->user_id)
    <button id="add-photo-btn" class="add-photo-btn">Ajouter une photo</button>

    <div id="add-photo-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter une photo</h2>
            <form method="post" action="{{ route('photo.store') }}" enctype="multipart/form-data" class="add-photo-form">
                @csrf    
                <input type="hidden" name="album_id" value="{{$id}}"></input>
                <div class="form-group">
                    <label for="titre">Titre de la photo</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" placeholder="Nom de la photo" required>
                </div>
                <div class="form-group">
                    <label for="image">Fichier image</label>
                    <input type="file" id="image" name="image" value="{{ old('image') }}" required>
                </div>
                <div class="form-group">
                    <label>Tags (optionnel)</label>
                    <div class="tags-section">
                        @foreach($liste_tags as $l)
                            <label class="tag-checkbox">
                                <input type="checkbox" name="tags[]" value="{{ $l->id }}">
                                {{ $l->nom }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <input type="submit" value="Ajouter">
            </form>
        </div>
    </div>
    @endif

@endauth

    <h1>{{$album->titre}}</h1>

@if($photos->isEmpty())

    <h1>Pas de photos !</h1>

@else
<div class="photo-grid">
    @foreach ($photos as $photo)
    <div class="photo-item">
    <span id="look">{{$photo->titre}}</span></br>
    <img src="{{ $photo->url }}" class="grand"></br>

        @foreach ($photo->tags as $tag)
            <span class="badge"> #{{ $tag->nom }}</span>
        @endforeach
        
        <form action="{{ route('photo.destroy', $photo->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')

            <input type="submit" class="btn ghost"
                onclick="return confirm('Supprimer cette photo ?')" value="Supprimer">
            </input>
        </form>
    </div>
    @endforeach
</div>
@endif

</div>

<script src="{{asset('js/script.js')}}"></script>
@endsection