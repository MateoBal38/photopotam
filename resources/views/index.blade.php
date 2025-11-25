@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')


<h1>ça marche</h1>

@foreach ($photos as $p)
    <div>
        <span>{{$p->titre}}</span>
        <img src='{{$p->url}}'>
    </div>
@endforeach

@endsection
