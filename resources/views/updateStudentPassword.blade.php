<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Student Password Update</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Student Password Update</b></h3></div>
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
										<b><label>Student ID</label></b>
										<input type="text" class="form-control" name="studentID"><br>
										<b><label>New Password</label></b>
										<input type="password" class="form-control" name="password"><br>
										<button type="submit" class="btn btn-primary"><b>Update Password</b></button>
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