<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Upload Timetables</title>
</head>
<body ng-app="" background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Upload Timetable</b></h3></div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								@if(count($errors)>0)
								<ul>
									@foreach($errors->all() as $error)
									<li class="alert alert-danger">{{$error}}</li>
									@endforeach
								</ul>
								@endif
								<form action="{{ url('uploadTimetable') }} " method="post" enctype="multipart/form-data" files="true">
									{{ csrf_field() }}
									<div class="form-group {{ $errors->has('class') ? 'has-error' : '' }}">
										<b><label>Class</label></b><br>
										<select class="form-control" name="class" required>
											<option value="">None</option>
											@foreach($classess as $key => $classValue)
											<option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group {{ $errors->has('timetableimage') ? 'has-error' : '' }}">
										<b><label>Upload timetable</label></b><br>
										<input type="file" name="timetableimage" id="file">
									</div>
									<button type="submit" class="btn btn-primary"><b>Submit</b></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>