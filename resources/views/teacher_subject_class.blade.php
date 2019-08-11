<!DOCTYPE html>
<html>

<head>
	<?php include 'import/Imports.php'; ?>
	<title>Teacher management</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Teacher Management</B></h3></div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								<form action="{{ url('assignClassesToTeacher') }}" method="post">
									{{ csrf_field() }}
									<div class="form-group">
									    <label>Teacher Id</label></B>
										<input type="text" name="teacherId" class="form-control" placeholder="01xxxxxxxx"><br>
									</div>
									<div class="form-group">
									    <label>Classes</label></B>
										<select name="classes[]" class="form-control" multiple required>
											<option value="">None</option>
											@foreach($classess as $key => $classValue)
											<option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
											@endforeach
										</select><br>
									</div>
									<div class="form-group">
									    <label>Subjects</label></B>
										<select name="subject" class="form-control" multiple required>
											<option value="">None</option>
											@foreach($subjectss as $key2 => $subjectValue)
											<option value="{{$subjectValue['subject']}}">{{$subjectValue['subject']}}</option>
											@endforeach
										</select><br>
									</div>
									<button type="submit" class="btn btn-primary"><B>Submit</B></button>
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