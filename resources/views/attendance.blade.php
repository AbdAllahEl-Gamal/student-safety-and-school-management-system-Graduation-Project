<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Attendance</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarTeacher')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Take Attendance</B></h3></div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								<form method="post" action=" {{ url('returnStudent') }} ">
									{{ csrf_field() }}
									<div class="row">
										<div class="col-xs-6">
											<div class="form-group">
											<B><label>Class</label></B><br>
											<select class="form-control" name="classs" required>
											<option value="">None</option>
											@foreach($classess as $key => $classValue)
											<option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
											@endforeach
											</select>
										</div>
										<div class="form-group">
											<B><label>Period</label></B><br>
											<select class="form-control" name="period" required>
												<option value="">None</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
										</div></div>
										<div class="col-xs-6">
											<br><br><button type="submit" class="btn btn-primary"><B>Search</B></button>
										</div>
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