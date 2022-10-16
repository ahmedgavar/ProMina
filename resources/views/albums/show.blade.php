@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/style_gallary.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<div class="lightbox-gallery">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">{{ $album->name }}</h2>
            <p class="text-center">Find the lightbox gallery for your project. click on any image to open gallary</p>
        </div>
        <div class="row photos">

            @foreach ($album->images as $img )
            <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="{{ asset($img->name) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset($img->name) }}"></a></div>


            @endforeach

        </div>
    </div>
</div>
@stop
