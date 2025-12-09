@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
@endpush

@section('content')


<form method="GET" action="/album">

    @csrf

    <input name="search" type="text" placeholder="Rechercher un album par date ou par nom" required></input>

    <input name="button" type="submit" placeholder="Rechercher"></input>

</form>


@foreach($albums as $a)

    <a href="/detailAlbum/{{$a->id}}">
        <div>

            <span>{{$a->titre}}</span>
            <span>{{$a->creation}}</span>
            <span>{{$a->user_id}}</span>
            @if($a->photos->isNotEmpty())
                <img src="{{ $a->photos->first()->url }}" alt="">
            @endif

        </div>
    </a>
@endforeach


@endsection