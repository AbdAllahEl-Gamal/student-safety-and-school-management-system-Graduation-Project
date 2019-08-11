<!DOCTYPE html>
<html>

<head>
	<?php include 'import/Imports.php'; ?>
	<title>Recovery Password</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Recovery Password</B></h3></div>
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
								<form action="{{ url('recoveryPassword') }}" method="post">
									{{ csrf_field() }}
									<div class="form-group">
										<label>Enter New Password:</label></B>
										<input type="password" class="form-control" name="password" required><br>
										<label>Enter Confirm Password</label></B>
										<input type="password" class="form-control" name="confirmPassword" required><br>
										<input type="hidden" name="id" value="{{$id}}">
										<input type="hidden" name="position" value="{{$position}}">
										<button typt="submit"><B>Change</B></button>
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