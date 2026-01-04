@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailAlbum.css') }}">
@endpush

@section('content')

<div class="container">

<form method="GET" action="{{ route('album.show', $id) }}">

    <input type="text" name="search" placeholder="Rechercher une photo" value="{{ request('search') }}">

    @foreach ($liste_tags as $tag)
        <label>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @if(is_array(request('tags')) && in_array($tag->id, request('tags'))) checked @endif>
            {{ $tag->nom }}
        </label>
    @endforeach

    <select name="note">
        <option value="">Trier par note</option>
        <option value="asc" @if(request('note') === 'asc') selected @endif>Notes croissantes</option>
        <option value="desc" @if(request('note') === 'desc') selected @endif>Notes décroissantes</option>
    </select>

    <input type="submit" value="Rechercher"></input>
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
                            <h4>Tags pour cette photo</h4>
                            <div id="tags-wrapper">
                                <input type="text" name="new_tags[]" placeholder="Nom du tag">
                            </div>

                            <input type="button" onclick="addTagInput()" value="Ajouter un tag" name="new_tags[]"></input>

                        <script>
                        function addTagInput() {
                            const wrapper = document.getElementById('tags-wrapper');
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.name = 'news_tags[]';
                            input.placeholder = 'Nom du tag';
                            wrapper.appendChild(input);
                        }
                        </script>

                </div>
                <div>
                    <label for="note">Note pour la photo :</label>
                    <select id="note" name="note">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
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

    <div>
        <span> Note : {{$photo->note}} </span>
        @foreach ($photo->tags as $tag)
            <span class="badge"> #{{ $tag->nom }}</span>
        @endforeach
    </div>    

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