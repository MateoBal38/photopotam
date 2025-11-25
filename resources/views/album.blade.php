@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
@endpush

@section('content')


@foreach($albums as $a)

    <a href="/detailAlbum/{{$a->id}}">
        <div>

            <span>{{$a->titre}}</span>
            <span>{{$a->creation}}</span>
            <span>{{$a->user_id}}</span>
            <img src="{{$a->photo_url}}">

        </div>
    </a>
@endforeach


@endsection