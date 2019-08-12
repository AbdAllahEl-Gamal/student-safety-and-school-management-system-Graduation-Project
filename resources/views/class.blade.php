<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Classroom management</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Classroom Management</b></h3></div>
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
						<li class={{Request::is('class')?"active":""}}><a data-toggle="pill" href="#add"><b>Add</b></a></li> 
						<li class={{Request::is('classview')?"active":""}}><a data-toggle="pill" href="#view"><b>View</b></a></li>
					</ul>
				</div>
				<div class="col-lg-4"></div>
			</div>

			<div class="tab-content">

				<div id="add" class="tab-pane fade in {{Request::is('class')?"active":""}}">
					<div class="panel-body">
						<div class="py-5">
							<div class="container">
								<div class="row">
									<div class="col-md-11">

										<form action="{{ url('addClass') }} " method="post" enctype="multipart/form-data" files="true">
											{{ csrf_field() }}

											<div class="form-group {{ $errors->has('classroomname') ? 'has-error' : '' }}">
												<b><label>Classroom</label></b> 
												<input type="text" name="classroomname" id="Classroomname" pattern="[A-Z\sa-z0-9]+" value="{{ old('classroomname') }}" class="form-control" placeholder="1AK">
												<header>
													<h1>Examples:</h1>
													<h6>Kindergarten (1AK)</h6>
													<h6>Primary (1AJ)</h6>
													<h6>Preparatory (1AP)</h6>
													<h6>Secondary (1AS)</h6>
												</header>
											</div>
											<button type="submit" class="btn btn-primary"><b>Submit</b></button>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="view" class="tab-pane fade in {{Request::is('classview')?"active":""}}">

					<div class="container">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-11">
									<div class="row">
										<div class="col-lg-6">
											<label><b><U>Classes</U></b></label>
										</div>
										<div class="col-lg-6">
											<label><b><U>Delete</U></b></label>
										</div>
									</div>
									<div class="row">
										@foreach($classess as $key => $classValue)
										<form action="{{url('classDelete')}}" method="post" enctype="multipart/form-data">
											{{ csrf_field() }}
											<input type="hidden" name="id" value="{{$key}}">
											<div class="col-lg-6">
												<label><b>{{$classValue['class']}}</b></label>
											</div>
											<div class="col-lg-6">
												<button type="submit" class="btn btn-primary"><b>Delete</b></button>
											</div>
										</form>
										@endforeach
									</div>

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