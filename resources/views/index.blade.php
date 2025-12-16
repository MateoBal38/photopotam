@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')

<div class="container">
    <div class="hero-carousel">
        <div class="carousel-track">

            @php $firstPhoto = $photos->first(); @endphp

            @foreach ($photos as $p)
                <div class="slide">
                    <img src="{{ $p->url }}" alt="{{ $p->titre }}">
                    <div class="overlay"></div>
                </div>
            @endforeach

            {{-- Slide dupliquée pour boucle infinie --}}
            <div class="slide">
                <img src="{{ $firstPhoto->url }}" alt="{{ $firstPhoto->titre }}">
                <div class="overlay"></div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const track = document.querySelector('.carousel-track');
    const slides = document.querySelectorAll('.slide');
    const total = slides.length - 1; // dernière = clone

    let index = 0;
    let isTransitioning = false;

    function nextSlide() {

        if (isTransitioning) return;
        isTransitioning = true;

        index++;

        track.style.transition = 'transform 1s ease-in-out';
        track.style.transform = `translateX(-${index * 100}%)`;

        if (index === total) {
            setTimeout(() => {
                track.style.transition = 'none';
                track.style.transform = 'translateX(0)';
                index = 0;
                isTransitioning = false;
            }, 1000);
        } else {
            setTimeout(() => {
                isTransitioning = false;
            }, 1000);
        }
    }

    setInterval(nextSlide, 4000);
});
</script>

@endsection
