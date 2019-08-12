<!DOCTYPE html>
<html>

<head>
	<?php include 'import/Imports.php'; ?>
	<title>Bus Insert</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Add Bus</b></h3></div>
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
								<form action="{{ url('insertBus') }}" method="post">
									{{ csrf_field() }}
									<div class="form-group">
										<b><label>Bus ID</label></b>
										<input type="textfield" class="form-control" name="busID"><br>
										<b><label>Driver:</label></b>
										<select id="driver" name="driver" class="form-control" required>
											<option value="">None</option>
											@for($i=0;$i<count($driverIds);$i++)
											<option value="{{$driverIds[$i]}}">{{$driverNames[$i]}}</option>
											@endfor
										</select><br>
										<b><label>Supervisor:</label></b>
										<select id="supervisor" name="supervisor" class="form-control" required>
											<option value="">None</option>
											@for($j=0;$j<count($supervisorIds);$j++)
											<option value="{{$supervisorIds[$j]}}">{{$supervisorNames[$j]}}</option>
											@endfor
										</select><br>
										<b><label>Line:</label></b>
										<select class="form-control" name="line" required>
											<option value="">None</option>
											@foreach($liness as $key => $lineValue)
											<option value="{{$lineValue['line']}}">{{$lineValue['line']}}</option>
											@endforeach
										</select><br>
										<input type="hidden" name="driverName" id="driverName" value="">
										<input type="hidden" name="supervisorName" id="supervisorName" value="">
										<button id="busBtn" type="submit" class="btn btn-primary"><b>Add</b></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$("#busBtn").click(function(event) {
		$("#supervisorName").val($("#supervisor").find(":selected").text());
		$("#driverName").val($("#driver").find(":selected").text());
	});
</script>
</body>
</html>