<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Classroom Access</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Access Classroom Information</b></h3></div> 
			<div class="panel-body">
				<form action="{{url('accessClass')}}" method="post">
					{{ csrf_field() }}
					<label>Class ID:</label></b>
					<select class="form-control" name="classid" required>
					   <option value="">None</option>
					   @foreach($classIds as $key => $classValue)
					   <option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
					   @endforeach
					</select><br>
					@foreach($classIds as $key => $classValue)
					<input type="hidden" name="classIds1[]" value="{{$classValue['class']}}">
					@endforeach
					
					<button type="submit" class="btn btn-primary"><b>Search</b></button>
				</form>
			</div>
		</div>
		@if(isset($names))
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Students</b></h3></div> 
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
						<label><b><U>Name</U></b></label>
					</div>
					<div class="col-lg-4">
						<label><b><U>Class</U></b></label>
					</div>
					<div class="col-lg-4">
						<label><b><U>Parent phone number</U></b></label>
					</div>
				</div>
				<div class="row">
					@for($i=0;$i<count($names);$i++)
					<div class="col-lg-4">
						<label><b>{{$names[$i]}}</b></label>
					</div>
					<div class="col-lg-4">
						<label><b>{{$classes[$i]}}</b></label>
					</div>
					<div class="col-lg-4">
						<label><b>{{$parentNumbers[$i]}}</b></label>
					</div>
					@endfor
				</div>
			</div>
		</div>
		@endif
	</div>
</body>
</html>