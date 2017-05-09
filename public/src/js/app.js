
var postId=0;
var postBodyElement=null;
var postTitleElement=null;

var postsShown=30;

$('.post').find('.interaction').find('.edit').on('click',function (event) { //makes the edit button open the modal window

  event.preventDefault();

  var postTitle=event.target.parentNode.parentNode.childNodes[1].textContent;
  var postBody=event.target.parentNode.parentNode.childNodes[3].textContent;

  postTitleElement=event.target.parentNode.parentNode.childNodes[1];
  postBodyElement=event.target.parentNode.parentNode.childNodes[3];

  postId=event.target.parentNode.parentNode.dataset['postid'];

  $('#title-edit').val(postTitle);
  $('#body-edit').val(postBody);

  //finds id of modal windows
  $('#edit-modal').modal();
})


$('#modal-save').on('click',function(){
  $.ajax({
    method:'POST',
    url: urlEdit,//pseudo url tp be set after
    data:{body:$('#body-edit').val(),title: $('#title-edit').val(),postId:postId,_token: token}
  })//goes to post route edit, and executes that code then comes back
  .done(function(msg){
    //when post was done. and db was updated
    console.log(JSON.stringify(msg));
    $(postBodyElement).text(msg['new_body']);
    $(postTitleElement).text(msg['new_title']);
    $('#edit-modal').modal('hide');
  });
});





//finds all items with class like
$('.like').on('click', function(event) {
  event.preventDefault();
  postId = event.target.parentNode.parentNode.dataset['postid'];
  var isLike = event.target.previousElementSibling == null?true:false;
  $.ajax({
    method: 'POST',
    url: urlLike,
    data: {isLike: isLike, postId: postId, _token: token}
  })
  .done(function() {
    //if we presse like btn
    if(isLike)
    {
      //reset disklike btn
      event.target.nextElementSibling.innerText='Downvote';

      if(event.target.innerText=='Upvote'){//and it was previusly unliked
        event.target.innerText='You upvoted this post';
      }else {
        event.target.innerText='Upvote';
      }}
      else {//if we press dislike button

        //reset like btn
        event.target.previousElementSibling.innerText='Upvote';

        if(event.target.innerText=='Downvote'){//and it was previusly unliked
          event.target.innerText='You downvoted this post';
        }else {
          event.target.innerText='Downvote';
        }
      }

    });
  });


  //finds all items with class like
  $('.showMore').on('click', function(event) {
    event.preventDefault();

    $.ajax({
      method: 'POST',
      url: urlShowMore,
      data: {postsShown: postsShown, _token: token}
    }).done(function(msg) {

      //gets the posts elements form the json object
      var posts = msg['posts'];
      //iterates all posts
      console.log(JSON.stringify(msg));
      if(posts.length!=0)
    {  $.each(posts, function(key,value){ $( ".posts" ).append(  "<div class='col-md-6 col-md-offset-3 well'><div class='post' data-postid="+value.id+"><h4><b>" +value.title+ "</b></h4><h5>" +value.body +"</h5><div class='info'>Posted by" + "CoolReplaceGuy" +"on" + "cooldate"+ "</div><div class='interaction'><a href='#' class='like'>Upvote</a><a href='#' class='like'>Downvote</a> |<a href='#'>Show Article</a> | <a href='#' class='edit'>Edit</a> | <a href='#'>Delete</a>    | Score: -0</div> </div>  </div>")
  });
  }
      else {
        $('.showMore').hide();
      }

  });

  postsShown+=30;
});
