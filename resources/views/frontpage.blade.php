@extends('layouts.master')

@section('title')
FrontPage
@endsection

@section('content')
@include('includes.message-block');
<section class="row posts ">
  <h2>Articles</h2>

  @foreach($posts as $post)
  <div class="col-md-6 col-md-offset-3 well">
    <div class="post" data-postid='{{$post->id}}'>
      <h4><b> {{$post->title}}</b></h4>
    <!--  <h5> {{$post->body}}</h5>-->
      <div class="info">
          Posted by {{$post->user->name}} on {{$post->created_at}}
      </div>
      <div class="interaction">
@if(Auth::check())
        <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first()?Auth::user()->likes()->where('post_id',$post->id)->first()->like==1? 'You upvoted this post':'Upvote':'Upvote'}}</a> |
        <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first()?Auth::user()->likes()->where('post_id',$post->id)->first()->like==0? 'You downvoted this post':'Downvote':'Downvote'}}</a> |
    @endif
        <a href="{{url('singlepost/'.$post->id)}}">Show Article</a>
@if(Auth::user()==$post->user)
        | <a href="#" class="edit">Edit</a>
        | <a href="{{route('post.delete',['post_id'=>$post->id])}}">Delete</a>
        @endif
        | Score: {{count($post->likes->where('like',1))-count($post->likes->where('like',0))}}

        <!--post_id must match parameter name in getDelete Post!-->
      </div>
    </div>
  </div>
  @endforeach

</section>

<a href="#" class="showMore">Show More</a>


<div class="modal fade" tabindex="-1" role="dialog" id='edit-modal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
      <form>
        <div class="form-group">
          <label for="title">title</label>
          <input class="form-control " type="text" name="title-edit" id="title-edit" value="">
        </div>
        <div class="form-group">
          <label for="title">body</label>
          <textarea class="form-control" name="body-edit" id='body-edit' rows="5" placeholder='Your Post' cols="80"></textarea>

        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  var token = '{{Session::token()}}'
  var urlEdit = '{{route('edit')}}'
  var urlLike = '{{route('like')}}'
  var urlShowMore = '{{route('showMore')}}'
</script>
@endsection
