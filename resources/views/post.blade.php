@extends('layouts.master')

@section('title')
New post
@endsection

@section('content')

<section class="row new-post">
  <div class="col-md-6 col-md-offset-3">
    <h3>What Link you would like to share?</h3>
    <form class="" action="{{route('post.create')}}" method="post">
      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control " type="text" name="title" id="title" value="">
      </div>
      <div class="form-group">
        <label for="Title">Post</label>
        <textarea class="form-control" name="body" id='new-post' rows="5" placeholder='Your Post' cols="80"></textarea>

      </div>
      <button type="submit" name="button" class="btn btn-primary" >New Post</button>
      <input type="hidden" name="_token" value="{{Session::token()}}">
    </form>
  </div>
</section>

@endsection
