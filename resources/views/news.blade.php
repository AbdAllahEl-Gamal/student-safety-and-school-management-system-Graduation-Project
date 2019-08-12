<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>News</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>News</b></h3></div>
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
						<li class={{Request::is('news')?"active":""}}><a data-toggle="pill" href="#add"><b>Add</b></a></li> 
						<li class={{Request::is('newsdelete')?"active":""}}><a data-toggle="pill" href="#delete"><b>Delete</b></a></li>
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
												<b><label>Title</label></b> 
												<input type="text" name="title" id="Empname" pattern="[A-Z\sa-z]+" value="{{ old('title') }}" class="form-control">
											</div>
											<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
												<label for="comment">Content</label>
												<textarea class="form-control" rows="5" name="content"> </textarea>
											</div>
											<div class="form-group">
												<b><label>Upload Picture</label></b>
												<input type="file" name="picture" id="file">
											</div>
											<button type="submit" class="btn btn-primary"><b>Submit</b></button>
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
									<label><b><U>News</U></b></label>
								</div>
								<div class="col-lg-6">
									<label><b><U>Delete</U></b></label>
								</div>
							</div>
							<div class="row">
								@foreach($newss as $key => $newsValue)
								<form action="{{url('deleteNews')}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$key}}">
								<div class="col-lg-6">
									<label><b>{{$newsValue['title']}}</b></label>
								</div>
								<div class="col-lg-6">
									<button type="submit" class="btn btn-primary"><b>Delete</b></button>
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