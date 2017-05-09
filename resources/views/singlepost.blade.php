@extends('layouts.master')

@section('title')
FrontPage
@endsection

@section('content')
<div class="col-md-6 col-md-offset-3 well">
  <div class="post" data-postid='{{$post->id}}'>
    <h4><b> {{$post->title}}</b></h4>
    <h5> {!!$post->body!!}</h5>
    <div class="info">
        Posted by {{$post->user->name}} on {{$post->created_at}}
    </div>
    <div class="interaction">
@if(Auth::check())
      <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first()?Auth::user()->likes()->where('post_id',$post->id)->first()->like==1? 'You upvoted this post':'Upvote':'Upvote'}}</a> |
      <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first()?Auth::user()->likes()->where('post_id',$post->id)->first()->like==0? 'You downvoted this post':'Downvote':'Downvote'}}</a> |
      <a href="#">Comment</a>
      @endif
@if(Auth::user()==$post->user)
      | <a href="#" class="edit">Edit</a>
      | <a href="{{route('post.delete',['post_id'=>$post->id])}}">Delete</a>
      @endif


      <!--post_id must match parameter name in getDelete Post!-->
    </div>
  </div>
</div>
<section class="row new-post">
  <div class="col-md-6 col-md-offset-3">
<h2>Comments</h2>
  @foreach($post->comments as $comment)
<div class="col-md-6 col-md-offset-3 well">
  <div class="post" data-postid='{{$comment->id}}'>

    <h5> {{$comment->comment}}</h5>
    <div class="info">
        by {{$comment->user->name}} on {{$comment->created_at}}
    </div>

  </div>
</div>
  @endforeach

</div>
</section>

@if(Auth::check())
  <section class="row new-post">
    <div class="col-md-6 col-md-offset-3">
      <h3>What Link you would like to share?</h3>
      <form class="" action="{{route('comments.store',['post_id'=>$post->id])}}" method="post">

        <div class="form-group">
          <label for="Title">Post</label>
          <textarea class="form-control" name="comment" id='comment' rows="5" placeholder='Your Post' cols="80"></textarea>

        </div>
        <button type="submit" name="button" class="btn btn-primary" >Add Comment</button>
        <input type="hidden" name="_token" value="{{Session::token()}}">
      </form>
    </div>
  </section>
  @else
  Login to comment
@endif


  <script type="text/javascript">
    var token = '{{Session::token()}}'
    var urlEdit = '{{route('edit')}}'
    var urlLike = '{{route('like')}}'
    var urlShowMore = '{{route('showMore')}}'
  </script>
@endsection
