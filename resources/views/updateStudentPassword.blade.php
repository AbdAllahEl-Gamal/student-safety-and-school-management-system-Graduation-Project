<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Student Password Update</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Student Password Update</B></h3></div>
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
								<form action="{{ url('updateStudentPass') }}" method="post">
									{{ csrf_field() }}
									<div class="form-group">
										<label>Student ID</label></B>
										<input type="text" class="form-control" name="studentID"><br>
										<label>New Password</label></B>
										<input type="password" class="form-control" name="password"><br>
										<button type="submit" class="btn btn-primary"><B>Update Password</B></button>
									</div>
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