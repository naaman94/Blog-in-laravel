{{--                        @if (Route::has('login'))--}}
{{--                            <div class="top-right links">--}}
{{--                                @auth--}}
{{--                                    <h1>log in </h1>--}}
{{--                                @else--}}
{{--                                    <h1>you are not log in </h1>--}}
{{--                                @endauth--}}
{{--                            </div>--}}
{{--                        @endif--}}


@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 50px ">
        @if(\route::current()->getName()==='My_Articles')
            <h1>My Articles</h1>
        @else
            <h1>Articles</h1>
        @endif
        @if(count($articles) > 0)
            <div class="container">

                @foreach ($articles as $article)
                    <div class="row">
                        {{--                    <div class="col-md-4 col-sm-4">--}}
                        {{--                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">--}}
                        {{--                    </div>--}}
                        <div class="col-md-8 col-sm-8">
                            <h2><a href="/Article/{{$article->id}}">{{$article->title}}</a></h2>
                            <small>Written on {{$article->created_at}} by {{$article->user->name}}</small>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <p>No posts found</p>
        @endif
    </div>

@endsection


