<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller{

  public function postCreatePost(Request $request)
  {
    //Validation
    $this->validate($request,[
      'body' => 'required|max:1000',
      'title' => 'required',
    ]);
    $post=new Post();

    if (filter_var($request['body'], FILTER_VALIDATE_URL)) {
    $request['body']=  '<a href='.$request['body'].'>See Link</a>';

    }

    $post->body=$request['body'];
    $post->title=$request['title'];

    $message='There was an error';
    if($request->user()->posts()->save($post))
    {
      $message='Post successful';
    }
    return redirect()->route('frontpage')->with(['message' => $message]);

  }

  public function getDashboard()
  {
    $posts=Post::orderBy('created_at','desc')->get(); //gets all posts from db, does a query
    //instead of Post::all
    return view('dashboard',['posts'=>$posts]);
  }

  public function getFrontPage()
  {
    $posts=Post::orderBy('created_at','desc')->take(30)->get(); //gets all posts from db, does a query
    //instead of Post::all
    return view('frontpage',['posts'=>$posts]);
  }

  public function getDeletePost($post_id)
  {
    $post = Post::where('id',$post_id)->first();
    //find($post_id)

    if(Auth::user()!=$post->user){//if the post is not your then dont delete it
      return redirect()->back();
    }

    $post->delete(); //deletes it from db
    return redirect()->route('frontpage')->with(['message'=>'Successfully deleted']);
  }


  public function postEditPost(Request $request)
  {


    $this->validate($request,['body=>required','title=>required']);

    $post =Post::find($request['postId']);

    if(Auth::user()!=$post->user){//if the post is not your then dont edit it
      return redirect()->back();
    }


    $post->body=$request['body'];
    $post->title=$request['title'];
    $post->update(); //THIS IS DIFFERENT FROM save()
    return response()->json(['new_body'=>$post->body,'new_title'=>$post->title],200);
  }
  public function getSinglePost($id)
  {
$post = Post::find($id);


  return view("singlepost")->withPost($post);

  }

  public function getShowMorePost(Request $request)
  {
$nSkip=$request['postsShown'];

  $posts=Post::orderBy('created_at','desc')->skip($nSkip)->take(30)->get(); //gets all posts from db, does a query

    return response()->json(['posts'=>$posts],200);
  }
  public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}
