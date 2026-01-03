@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailAlbum.css') }}">
@endpush

@section('content')


<form method="GET" action="{{ route('album.show', $id) }}">

    <input
        type="text"
        name="search"
        placeholder="Rechercher une photo"
        value="{{ request('search') }}"
    >

    @foreach ($liste_tags as $tag)
        <label>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @if(is_array(request('tags')) && in_array($tag->id, request('tags'))) checked @endif>
            {{ $tag->nom }}
        </label>
    @endforeach

    <input type="submit" value="Rechercher"></input>
</form>



@auth 
    @if(Auth::id() == $album->user_id)
    <form method="post" action="{{ route('photo.store') }}" enctype="multipart/form-data">
        @csrf    
        <input type="hidden" name="album_id" value="{{$id}}"></input>
        <input type="text" name="titre" value="{{ old('titre') }}" placeholder="Nom de la photo" required></input>
        <input type="file" name="image" value="{{ old('image') }}" required></input>
            @foreach($liste_tags as $l)
                <label>
                    <input type="checkbox" name="tags[]" value="{{ $l->id }}">
                    {{ $l->nom }}
                </label>
            @endforeach

        <input type="submit" value="Ajouter une photo"></input>
    </form>
    @endif

@endauth

    <h1>{{$album->titre}}</h1>
    <h2>{{optional($album->user)->name}}</h2>

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

<script src="{{asset('js/script.js')}}"></script>
@endsection