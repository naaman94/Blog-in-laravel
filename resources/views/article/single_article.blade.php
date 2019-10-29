@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>{{$article->title}}</h1>
            <hr>
            <small>Written on {{$article->created_at}} by {{$article->user->name}}</small>
            <div  style="display:inline-block; right: 0;">
                @if(!\Illuminate\Support\Facades\Auth::guest())
                    @if(\Illuminate\Support\Facades\Auth::user()->id == $article->user_id)
                        <a href="/Article/{{$article->id}}/edit" class="btn btn-default">Edit</a>

                        <form style='display: inline-block' method='post' action='/Article/{{$article->id}}'>
                            @method('delete')
                            @csrf
                            <button name='delete_item' type='submit'
                                    style=' width: 30px; height: 30px; text-align: center; padding: 6px 0; font-size: 12px; line-height: 1.428571429; border-radius: 15px '
                                    class='btn btn-danger btn-circle btn-lg'>X
                            </button>
                        </form>
                    @endif
                @endif
            </div>
            <br>
            <br>
            <p>{{$article->body}}</p>
            <hr>


        </div>


        <div>
            <h3>Comments :</h3>
            <br>
            @if(count($article->comments) > 0)
                <div>
                    @foreach ($article->comments as $comment)
                        <div style="margin-bottom: 20px;">
                            <p>{{$comment->body}}</p>
                            <small>Written on {{$comment->created_at}} by {{$comment->user->name}}</small>
                            @if(!\Illuminate\Support\Facades\Auth::guest())
                                @if(\Illuminate\Support\Facades\Auth::user()->id == $comment->user_id)
                                    <form style='display: inline-block' method='post'
                                          action='/Comment/{{$comment->id}}'>
                                        @method('delete')
                                        @csrf
                                        <button name='delete_item' type='submit'
                                                style=' width: 30px; height: 30px; text-align: center; padding: 6px 0; font-size: 12px; line-height: 1.428571429; border-radius: 15px '
                                                class='btn btn-danger btn-circle btn-lg'>X
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                </div>
                @endforeach

            @else
                <p>No Comments found</p>
            @endif
        </div>
        @if(!\Illuminate\Support\Facades\Auth::guest())
            <div>
                <form class="form-inline" method="post" action="{{route('Comment.store')}}">
                    @csrf

                    <input name="article_id" type="hidden" value="{{$article->id}}">
                    <input name="body" type="text" class="form-control form-control-lg" id="task1"
                           placeholder="write Comment ....">
                    <button type="submit" class="btn btn-primary mx-2">Submit</button>
                </form>
            </div>
        @else
            <h5>To add new comment <a href="/login" class="">Login</a> pleas </h5>
        @endif

        {{--        <form>--}}
        {{--            <div class="row">--}}
        {{--                <div class="col">--}}
        {{--                    <input type="text" class="form-control" placeholder="First name">--}}
        {{--                </div>--}}
        {{--                <div class="col">--}}
        {{--                    <input type="text" class="form-control" placeholder="Last name">--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </form>--}}
    </div>




@endsection
