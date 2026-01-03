@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
@endpush

@section('content')

<div class="container">
    <div id="albums_container">
        @foreach($albums as $a)
            <a href="{{ route('album.show', $a->id) }}" style="text-decoration:none;">
                <div class="album-card">
                    @if($a->photos->isNotEmpty())
                        <img class="thumb" src="{{ $a->photos->first()->url }}" alt="{{ $a->titre }}">
                    @else
                        <div class="thumb" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));color:var(--muted);">Aucune photo</div>
                    @endif
                    <div class="album-meta">
                        <div class="title">{{ $a->titre }}</div>
                        <div class="info">Créé le {{ $a->creation }}</div>
                        <a href="#" class="delete-link" onclick="event.stopPropagation(); document.getElementById('form-{{$a->id}}').submit();">Supprimer</a>
                    </div>
                </div>
            </a>
            <form action="{{ route('album.destroy', $a->id) }}" method="POST" id="form-{{$a->id}}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>
</div>

@endsection