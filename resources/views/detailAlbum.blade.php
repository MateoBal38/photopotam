@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailAlbum.css') }}">
@endpush

@section('content')


<form method="GET" action="/detailAlbum/{{$id}}">

    @csrf

    <input name="search" type="text" placeholder="Rechercher une photo" required></input>

    <input name="button" type="submit" placeholder="Rechercher"></input>

</form>

@if($liste_tags)

    @foreach($liste_tags as $l)

        <a href="/detailAlbum/{{$id}}?tag={{$l->nom}}">{{$l->nom}}</a>
    @endforeach

@endif

@if($album == [])

    <h1>Pas de photos !</h1>

@else
    <h1>{{$album[0]->titre_album}}</h1>

    @foreach($album as $a)

        <img src="{{$a->url}}" alt="{{$a->titre}}">
        <h2>{{$a->titre}}</h2>
        
        @foreach($tags as $t)
            @if($t->photo_id == $a->id)
                <span>{{$t->nom}}</span>
            @endif
        @endforeach
        

    @endforeach
@endif


@endsection