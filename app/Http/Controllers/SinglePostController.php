<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SinglePostController extends Controller{

  public function getSinglePost($id)
  {
    $data['id'] = $id;
     return View::make('simple', $data);

  }


}
