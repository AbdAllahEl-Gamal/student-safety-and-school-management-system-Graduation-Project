<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Bus line</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Bus Line</b></h3></div>
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
						<li class={{Request::is('line')?"active":""}}><a data-toggle="pill" href="#add"><b>Add</b></a></li> 
						<li class={{Request::is('lineview')?"active":""}}><a data-toggle="pill" href="#view"><b>Delete</b></a></li>
					</ul>
				</div>
				<div class="col-lg-4"></div>
			</div>

			<div class="tab-content">

				<div id="add" class="tab-pane fade in {{Request::is('line')?"active":""}}">
					<div class="panel-body">
						<div class="py-5">
							<div class="container">
								<div class="row">
									<div class="col-md-11">

										<form action="{{ url('addLine') }} " method="post" enctype="multipart/form-data" files="true">
											{{ csrf_field() }}

											<div class="form-group {{ $errors->has('linename') ? 'has-error' : '' }}">
												<b><label>Line</label></b> 
												<input type="text" name="linename" id="Linename" pattern="[A-Z\sa-z]+" value="{{ old('linename') }}" class="form-control" placeholder="Smouha">
											</div>
											<button type="submit" class="btn btn-primary"><b>Submit</b></button>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="view" class="tab-pane fade in {{Request::is('lineview')?"active":""}}">

					<div class="container">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-11">
										<div class="row">
								<div class="col-lg-6">
									<label><b><U>Lines</U></b></label>
								</div>
								<div class="col-lg-6">
									<label><b><U>Delete</U></b></label>
								</div>
							</div>
							<div class="row">
								@foreach($liness as $key => $lineValue)
								<form action="{{url('lineDelete')}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$key}}">
								<div class="col-lg-6">
									<label><b>{{$lineValue['line']}}</b></label>
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