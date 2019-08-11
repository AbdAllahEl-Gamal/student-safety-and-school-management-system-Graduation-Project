<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Classroom Access</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Access Classroom Information</B></h3></div> 
			<div class="panel-body">
				<form action="{{url('accessClass')}}" method="post">
					{{ csrf_field() }}
					<label>Class ID:</label></B>
					<select class="form-control" name="classid" required>
					   <option value="">None</option>
					   @foreach($classIds as $key => $classValue)
					   <option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
					   @endforeach
					</select><br>
					@foreach($classIds as $key => $classValue)
					<input type="hidden" name="classIds1[]" value="{{$classValue['class']}}"></input>
					@endforeach
					
					<button type="submit" class="btn btn-primary"><B>Search</B></button>
				</form>
			</div>
		</div>
		@if(isset($names))
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Students</B></h3></div> 
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
						<label><B><U>Name</U></B></label>
					</div>
					<div class="col-lg-4">
						<label><B><U>Class</U></B></label>
					</div>
					<div class="col-lg-4">
						<label><B><U>Parent phone number</U></B></label>
					</div>
				</div>
				<div class="row">
					@for($i=0;$i<count($names);$i++)
					<div class="col-lg-4">
						<label><B>{{$names[$i]}}</B></label>
					</div>
					<div class="col-lg-4">
						<label><B>{{$classes[$i]}}</B></label>
					</div>
					<div class="col-lg-4">
						<label><B>{{$parentNumbers[$i]}}</B></label>
					</div>
					@endfor
				</div>
			</div>
		</div>
		@endif
	</div>
</body>
</html>