<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Ask your teacher</title>
	<style>
.notes {
    color: #999;
    font-size: 12px;
}
.media .media-object { max-width: 120px; }
.media-body { position: relative; }
.media-date { 
    position: absolute; 
    right: 25px;
    top: 25px;
}
.media-date li { padding: 0; }
.media-date li:first-child:before { content: ''; }
.media-date li:before { 
    content: '.'; 
    margin-left: -2px; 
    margin-right: 2px;
}
.media-comment { margin-bottom: 20px; }
.media-replied { margin: 0 0 20px 50px; }
.media-replied .media-heading { padding-left: 6px; }
	</style>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarStudent')
	
	<div class="container">
		<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><B>Ask Your Teacher</B></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="panel-body">
				<div class="row">
					<div class="col-md-12">
								@if(count($errors)>0)
								<ul>
									@foreach($errors->all() as $error)
									<li class="alert alert-danger">{{$error}}</li>
									@endforeach
								</ul>
								@endif	
								<form action="{{ url('addpost') }}" method="post">
									{{ csrf_field() }}

									<div class="row">
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
												<B><label for="comment">Ask a Question:</label></B>
												<textarea class="form-control" rows="5"  name="question" placeholder="Ask your question ..." style="height: auto;"></textarea>
											</div>

										</div>
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
												<B><label>Subject</label></B><br>
												<select name="subject" id="subject" class="form-control">
													<option value="">None</option>
													@foreach($subjectss as $key => $subjectValue)
													<option value="{{$key}}">{{$key}}</option>
													@endforeach
												</select>
											</div>
											<button style="margin: 10%" type="submit" class="btn btn-primary"><B>Submit</B></button>
										</div>
									</div>

								</form>

							</div>
						</div>
					@if(isset($post2))
						<div class="row">
					@foreach ($post2 as $key => $post)
							<div class="col-md-11">
	               
                    <ul class="media-list">
                      <li class="media">
                        <div class="pull-left">
                          <img class="media-object img-circle"  src="{{$post['posts']['pic']}}" alt="profile">
                        </div>
                        <div class="media-body">
                          <div class="well well-lg">
                              <h4 class="media-heading text-uppercase reviews">{{$post['posts']['name']}} </h4>
                              <ul class="media-date text-uppercase reviews list-inline">
							  <div class="col-md-3">
												<form action="{{ url('deletePost') }}" method="post">
													{{ csrf_field() }}
													<input type="hidden" name="postId" value="{{$key}}">
													<button type="submit" class="btn btn-large"><span class="glyphicon glyphicon-remove-sign"></span></button>
												</form>
											</div>
											
                              </ul>
                              <p class="media-comment">
                                {{$post['posts']['post']}}<br>
								<h5>{{$post['posts']['subject']}}
								{{$post['posts']['date']}}</h5>
                              </p>
                          </div>              
                        </div>
						@if(isset($post['comments']))
				        @foreach($post['comments'] as $comment)
                            <ul class="media-list">
                                <li class="media media-replied">
                                    <div class="pull-left">
                                      <img class="media-object img-circle" src="{{$comment['pic']}}" alt="profile">
                                    </div>
                                    <div class="media-body">
                                      <div class="well well-lg">
                                          <h4 class="media-heading text-uppercase reviews"><span class="glyphicon glyphicon-share-alt"></span> {{$comment['name']}}</h4>
                                          <p class="media-comment">
                                            {{$comment['comment']}}
											<h5>{{$comment['date']}}</h5>
                                          </p>
                                      </div>              
                                    </div>
                                </li>
                            </ul>
                        @endforeach
						@endif							
                      </li>   
                        				  
                      </li>
                    </ul>
                    <div class="row">
								<div class="col-md-11">
									<form action="{{url('addcomment')}}" method="post">
										{{ csrf_field() }}
										<input type="hidden" name="postId" value="{{$key}}">
										<textarea type="text" name="comment" placeholder="Type your comment ..." wrap="hard" rows="1" cols="90" style="resize: none;height: auto"></textarea>
										<button type="submit" class="btn btn-primary"><B>Add</B></button>
									</form>
								</div>
					</div>
					<br>
						</div>
						@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
			
</body>
</html>