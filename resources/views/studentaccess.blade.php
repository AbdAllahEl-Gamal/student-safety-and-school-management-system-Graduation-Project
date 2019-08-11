<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Student Access</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarTeacher') <!-- mmkn a5zn el nav f session m3a login -->
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Access Student Information</B></h3></div> 
			<div class="panel-body">
				<form action="{{url('accessStudent')}}" method="post">
					{{ csrf_field() }}
					<B>Student ID:</B> <input type="text" name="studentid">
					<button type="submit" class="btn btn-primary"><B>Search</B></button>
				</form>
			</div>
		</div>
		@if(isset($name))
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><B>{{$name}}</B></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3 col-lg-3 " align="center"> <img alt="Student Picture" src="{{$pic}}" class="img-circle img-responsive"> </div>
					<div class=" col-md-9 col-lg-9 "> 
						<table class="table table-user-information">
							<tbody>
								<tr>
									<td>Class:</td>
									<td>{{$class}}</td>
								</tr>
								<tr>
									<td>Parent Phone Number:</td>
									<td>{{$parentPhone}}</td>
								</tr>
								<tr>
									<td>Bus Number:</td>
									<td>{{$bus}}</td>
								</tr>                
								<tr>
									<tr>
										<td>Supervisor Name:</td>
										<td>{{$supername}}</td>
									</tr>
									<tr>
										<td>Supervisor Phone Number:</td>
										<td>{{$superphone}}</td>
									</tr>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><B>Timetable</B></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<img src="{{$timetablepic}}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading"><h3><B>Grades</B></h3></div> 
			<div class="panel-body">
				<div class="row">
					@if($subjects)
					@foreach($subjects as $key => $value)
					<div class="col-md-4">
						<table class="table table-striped">
							<thead align="center"><b><h3>{{$key}}</h3></b></thead>
							@foreach($value as $nkey => $nvalue)
							<tr align="center">
								<td>{{$nkey}}</td>
								<td>{{$nvalue}}</td>
							</tr>
							@endforeach
						</table>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading"><h3><B>Attendance</B></h3></div> 
			<div class="panel-body">
				<div class="row">
					@if($attendance)
					@foreach($attendance as $key => $value)
					<div class='col-md-4'>
						<table class="table table-striped">
							<thead align='center'><b><h3>{{$key}}</h3></b></thead>
							<?php ksort($value)?>
							@foreach($value as $nkey => $nvalue)
							<tr align='center'>
								<td>{{$nkey}}</td>
								<td>{{$nvalue}}</td>
							</tr>
							@endforeach
						</table>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
		@endif
	</div>
</body>
</html>