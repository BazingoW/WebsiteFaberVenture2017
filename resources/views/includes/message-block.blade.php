@if(count($errors)>0)
<div class="row">
  <div class="col-md-6  ">

      <ul  class="list-group">
          @foreach ($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{$error}}</li>
          @endforeach
      </ul>


  </div>
</div>
@endif
@if(Session::has('message'))
<div class="row">
  <div class="col-md-6 alert alert-success ">

      {{Session::get('message')}}


  </div>
</div>
@endif
