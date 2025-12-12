@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')

<div class="hero-carousel container">
    <div class="carousel-track">
        @foreach ($photos as $p)
            <div class="slide">
                <img src="{{ $p->url }}" alt="{{ $p->titre }}">
                <div class="overlay"></div>
            </div>
        @endforeach
    </div>
</div>

<script>
    const track = document.querySelector('.carousel-track');
    const slides = document.querySelectorAll('.slide');
    const total = slides.length;

    let index = 0;

    function nextSlide() {
        if (index === total - 1) {
            setTimeout(() => {
                track.style.transition = "none";
                track.style.transform = "translateX(0)";
                index = 0;
            }, 1000);
        }

        index++;

        track.style.transition = "transform 1s ease-in-out";
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(nextSlide, 4000);
</script>



@endsection
