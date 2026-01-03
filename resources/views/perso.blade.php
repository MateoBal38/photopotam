@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
@endpush

@section('content')

@foreach($albums as $a)

    <a href="{{ route('album.show', $a->id)}}">
        <div>

            <span>{{$a->titre}}</span>
            <span>{{$a->creation}}</span>
            <span>{{$a->user_id}}</span>
            @if($a->photos->isNotEmpty())
                <img src="{{ $a->photos->first()->url }}" alt="">
            @endif

            <a href="#"
            onclick="document.getElementById('form.{{$a->id}}').submit();">Delete</a>
            <form action="{{ route('album.destroy', $a->id) }}" method="POST" id="form.{{$a->id}}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            
        </div>
    </a>
@endforeach


@endsection