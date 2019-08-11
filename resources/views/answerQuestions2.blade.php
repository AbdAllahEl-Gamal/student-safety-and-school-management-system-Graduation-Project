<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
.panel-shadow {
    box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
}
.panel-white {
  border: 1px solid #dddddd;
}
.panel-white  .panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #ddd;
}
.panel-white  .panel-footer {
  background-color: #fff;
  border-color: #ddd;
}

.post .post-heading {
  height: 95px;
  padding: 20px 15px;
}
.post .post-heading .avatar {
  width: 60px;
  height: 60px;
  display: block;
  margin-right: 15px;
}
.post .post-heading .meta .title {
  margin-bottom: 0;
}
.post .post-heading .meta .title a {
  color: black;
}
.post .post-heading .meta .title a:hover {
  color: #aaaaaa;
}
.post .post-heading .meta .time {
  margin-top: 8px;
  color: #999;
}
.post .post-image .image {
  width: 100%;
  height: auto;
}
.post .post-description {
  padding: 15px;
}
.post .post-description p {
  font-size: 14px;
}
.post .post-description .stats {
  margin-top: 20px;
}
.post .post-description .stats .stat-item {
  display: inline-block;
  margin-right: 15px;
}
.post .post-description .stats .stat-item .icon {
  margin-right: 8px;
}
.post .post-footer {
  border-top: 1px solid #ddd;
  padding: 15px;
}
.post .post-footer .input-group-addon a {
  color: #454545;
}
.post .post-footer .comments-list {
  padding: 0;
  margin-top: 20px;
  list-style-type: none;
}
.post .post-footer .comments-list .comment {
  display: block;
  width: 100%;
  margin: 20px 0;
}
.post .post-footer .comments-list .comment .avatar {
  width: 35px;
  height: 35px;
}
.post .post-footer .comments-list .comment .comment-heading {
  display: block;
  width: 100%;
}
.post .post-footer .comments-list .comment .comment-heading .user {
  font-size: 14px;
  font-weight: bold;
  display: inline;
  margin-top: 0;
  margin-right: 10px;
}
.post .post-footer .comments-list .comment .comment-heading .time {
  font-size: 12px;
  color: #aaa;
  margin-top: 0;
  display: inline;
}
.post .post-footer .comments-list .comment .comment-body {
  margin-left: 50px;
}
.post .post-footer .comments-list .comment > .comments-list {
  margin-left: 50px;
}
</style>
<body class="w3-theme-l5" background="assets/img/backgrounds/1.jpg">
  @include('import/navbarTeacher')

  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
          <div class="w3-container">
           <h4 class="w3-center">My Profile</h4>
           <p class="w3-center"><img src="data:image/png;base64,{{$pic}}" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
           <hr>
           <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>{{$name}}</p>
           <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>{{$email}}</p>
           <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>{{$dateofbirth}}</p>
         </div>
       </div>
       <br>

       <!-- Accordion -->
       <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Classes</button>
          <div id="Demo1" class="w3-hide w3-container">
            <ul>
            @foreach($classess as $key => $classValue)
            <li>{{$classValue['class']}}({{$classValue['studentsNumber']}})</li>
            @endforeach
            </ul>
          </div>
        </div>      
      </div>
      <br>     
      <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">

      @if(isset($post2))
      @foreach ($post2 as $key => $post)
      <div class="container bootstrap snippet">
        <div class="col-sm-8">
          <div class="panel panel-white post panel-shadow">
            <div class="post-heading">
              <div class="pull-left image">
                <img src="{{$post['posts']['pic']}}" class="img-circle avatar" alt="user profile image">
              </div>
              <div class="pull-left meta">
                <div class="title h5">
                  <a href="#"><b>{{$post['posts']['name']}}</b></a>
                  ask a question.
                </div>
                <h6 class="text-muted time">{{$post['posts']['date']}}</h6>
              </div>
            </div> 
            <div class="post-description"> 
              <p>{{$post['posts']['post']}}</p>
            </div>
            <div class="post-footer">
              <form action="{{url('addcommentTeacher')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="postId" value="{{$key}}">
                <input type="hidden" name="studentId" value="{{$post['studentId']}}">
                <div class="input-group"> 
                  <input class="form-control" placeholder="Add a comment" name="comment" type="text">
                  <span class="input-group-addon">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>  
                  </span>
                </div>
              </form>
              <ul class="comments-list">
                @if(isset($post['comments']))
                @foreach($post['comments'] as $comment)
                <li class="comment">
                  <a class="pull-left" href="#">
                    <img class="avatar" src="{{$comment['pic']}}" alt="avatar">
                  </a>
                  <div class="comment-body">
                    <div class="comment-heading">
                      <h4 class="user">{{$comment['name']}}</h4>
                      <h5 class="time">{{$comment['date']}}</h5>
                    </div>
                    <p>{{$comment['comment']}}</p>
                  </div>
                </li>
                @endforeach
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif

      <!-- End Middle Column -->
    </div>


    <!-- End Grid -->
  </div>

  <!-- End Page Container -->
</div>
<br>


<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}
</script>

</body>
</html> 
