<!DOCTYPE html>
<html>

<head>
	<?php include 'import/Imports.php'; ?>
	<title>Bus</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Assign Seat</B></h3></div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								<form action="{{ url('studentBuss') }}" method="post">
									{{ csrf_field() }}
									<div class="form-group">
										<label>Student ID</label></B>
										<input type="textfield" class="form-control" name="student_id"><br>
										<button type="submit" class="btn btn-primary"><B>Search</B></button>
									</div>
								</form>
								@if(isset($id))
								<form action="{{ url('studentBuss1') }}" method="post">
									{{ csrf_field() }}
									<input type="text" name="id" value="{{$id}}" readonly>
									<input type="text" name="name" value="{{$name}}" readonly>
									<input type="text" name="class" value="{{$class}}" readonly>
									<div class="form-group">
										<label>Bus ID</label></B>
										<select name="bus_id" class="form-control" required>
											<option value="none">---------</option>
											@for($i=0;$i<count($busIds);$i++)
											<option value="{{$busIds[$i]}}">{{$busIds[$i]}}</option>
											@endfor
										</select><br>
										<button type="submit" class="btn btn-primary"><B>Add</B></button>
									</div>
								</form>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>