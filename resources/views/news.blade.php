<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>News</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>News</B></h3></div>
			@if(count($errors)>0)
			<ul>
				@foreach($errors->all() as $error)
				<li class="alert alert-danger">{{$error}}</li>
				@endforeach
			</ul>
			@endif
			<div class="row">
				<div class="col-lg-5"></div>
				<div class="col-lg-4">
					<ul class="nav nav-pills">
						<li class={{Request::is('news')?"active":""}}><a data-toggle="pill" href="#add"><B>Add</B></a></li> 
						<li class={{Request::is('newsdelete')?"active":""}}><a data-toggle="pill" href="#delete"><B>Delete</B></a></li>
					</ul>
				</div>
				<div class="col-lg-4"></div>
			</div>

			<div class="tab-content">

				<div id="add" class="tab-pane fade in {{Request::is('news')?"active":""}}">
					<div class="panel-body">
						<div class="py-5">
							<div class="container">
								<div class="row">
									<div class="col-md-11">

										<form action="{{ url('addNews') }} " method="post" enctype="multipart/form-data" files="true">
											{{ csrf_field() }}

											<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
												<B><label>Title</label></B> 
												<input type="text" name="title" id="Empname" pattern="[A-Z\sa-z]+" value="{{ old('title') }}" class="form-control">
											</div>
											<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
												<label for="comment">Content</label>
												<textarea class="form-control" rows="5" name="content"> </textarea>
											</div>
											<div class="form-group">
												<B><label>Upload Picture</label></B>
												<input type="file" name="picture" id="file">
											</div>
											<button type="submit" class="btn btn-primary"><B>Submit</B></button>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="delete" class="tab-pane fade in {{Request::is('newsdelete')?"active":""}}">

					<div class="container">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-11">
										<div class="row">
								<div class="col-lg-6">
									<label><B><U>News</U></B></label>
								</div>
								<div class="col-lg-6">
									<label><B><U>Delete</U></B></label>
								</div>
							</div>
							<div class="row">
								@foreach($newss as $key => $newsValue)
								<form action="{{url('deleteNews')}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$key}}">
								<div class="col-lg-6">
									<label><B>{{$newsValue['title']}}</B></label>
								</div>
								<div class="col-lg-6">
									<button type="submit" class="btn btn-primary"><B>Delete</B></button>
								</div>
								@endforeach
							</div>
							</form>
							</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</body>
</html>