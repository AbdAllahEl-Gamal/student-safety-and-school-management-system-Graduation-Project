<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Answer Questions</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarTeacher')
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Answer Questions</b></h3></div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						@if(isset($post2))
						<div class="row">
							@foreach ($post2 as $key => $post)
							<div class="row">
								<div class="col-md-11">
									<section>
										<div class="row">
											<div class="col-md-2">
												<img width="50" height="40" src="{{$post['posts']['pic']}}">
											</div>
											<div class="col-md-3" align="left">
												<p>{{$post['posts']['name']}}</p>
											</div>
											<div class="col-md-4">
												<h5>{{$post['posts']['subject']}}</h5>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<h4>{{$post['posts']['post']}}</h4>
											</div>
											<div class="col-md-3">
												<h5>{{$post['posts']['date']}}</h5>
											</div>
										</div>
									</section>
								</div>
							</div>
							
							<div class="container">
								<div class="col-md-11">
									<div class="panel panel-primary">
										<div class="panel-heading"><b>Comments</b></div>
										<div class="panel-body">
											@if(isset($post['comments']))
											@foreach($post['comments'] as $comment)
											<div class="row">
												<div class="col-md-0"></div>
												<div class="col-md-6">
													<section>
														<div class="row">
															<div class="col-md-2">
																<img width="50" height="40" src="{{$comment['pic']}}">
															</div>
															<div class="col-md-6" align="left">
																<h4>{{$comment['name']}}</h4>
															</div>
														</div>
														<div class="row">
															<div class="col-md-8">
																<h4>{{$comment['comment']}}</h4>
															</div>
															<div class="col-md-3">
																<h5>{{$comment['date']}}</h5>
															</div>
														</div>
													</section>
												</div>
											</div>
											@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-11">
									<form action="{{url('addcommentTeacher')}}" method="post">
										{{ csrf_field() }}
										<input type="hidden" name="postId" value="{{$key}}">
										<input type="hidden" name="studentId" value="{{$post['studentId']}}">
										<textarea type="text" name="comment" placeholder="Type your comment ..." wrap="hard" rows="1" cols="110" style="resize: none;height: auto"></textarea>
										<button type="submit" class="btn btn-primary"><b>Add</b></button>
									</form>
								</div>
							</div>
							<br>
							@endforeach
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>