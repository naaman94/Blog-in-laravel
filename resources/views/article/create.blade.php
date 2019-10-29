@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('Article.store')}}">
            @csrf
            <div class="form-group">
                <label for="task1">Post Title</label>
                <input name="title" type="text" class="form-control" id="task1" placeholder="Enter Task" required>
            </div>

            <div class="form-group">
                <label for="body">Example textarea</label>
                <textarea name="body" class="form-control" id="body" rows="3" required></textarea>
            </div>

            <input name="img_link" type="hidden" value="0">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection


