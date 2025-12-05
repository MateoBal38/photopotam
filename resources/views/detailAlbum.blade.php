@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailAlbum.css') }}">
@endpush

@section('content')


<form method="GET" action="/detailAlbum/{{$id}}">

    @csrf

    <input name="search" type="text" placeholder="Rechercher une photo" required></input>

    <input name="button" type="submit" placeholder="Rechercher"></input>

    <select name="tags[]" multiple>
        @foreach($liste_tags as $tag)
            <option value="{{ $tag->nom }}"
                @if(is_array(request('tags')) && in_array($tag->nom, request('tags'))) selected @endif
            >
                {{ $tag->nom }}
            </option>
        @endforeach
    </select>

</form>

@if($liste_tags)

    @foreach($liste_tags as $l)
    <a href="?tag={{ $l->nom }}"
       class="{{ request('tag') == $l->nom ? 'active-tag' : '' }}">
        {{ $l->nom }}
    </a>
@endforeach

@endif

    <h1>{{$album->titre}}</h1>

@if($photos->isEmpty())

    <h1>Pas de photos !</h1>

@else
<div class="photo-grid">
    @foreach ($photos as $photo)
    <div class="photo-item">
    <span id="look">{{$photo->titre}}</span></br>
    <img src="{{ $photo->url }}"></br>

        @foreach ($photo->tags as $tag)
            <span class="badge"> #{{ $tag->nom }}</span>
        @endforeach
    </div>
    @endforeach
</div>
@endif


@endsection