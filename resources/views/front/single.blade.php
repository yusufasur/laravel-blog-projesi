@extends('front.layouts.master')

@section('title', $article->title)

@section('bg', $article->image)

@section('content')
    <!-- Post Content -->
    <div class="col-md-9 mx-auto">
        {!! $article->content !!}
        <br><br>
        <div class="text text-dark">Okunma Sayısı : <b>{{ $article->hit }}</b></div>
    </div>
    @include('front.widgets.categoryWidget')
@endsection

