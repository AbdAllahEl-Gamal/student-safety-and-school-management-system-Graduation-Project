<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Bus Delete</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3>Bus</h3></div>
			
			<div class="container">
				<div class="panel-body">
					<form action="{{url('busDelete1')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<b>bus ID:</b> <input type="text" name="busid">
						<button type="submit" class="btn btn-primary"><b>Search</b></button>
					</form>
				</div>
			</div>

			@if(isset($drivername))
			<div class="panel panel-default">
				<div class="panel-heading"><h3><b>Bus Information</b></h3></div> 
				<div class="panel-body">
					<div class="py-5">
						<div class="container">
							<div class="row">
								<div class="col-md-11">
									<form action="{{url('busDelete2')}}" method="post" enctype="multipart/form-data">
										{{ csrf_field() }}
										<b><label>Bus ID: </label></b>
										<input type="tect" name="busid2" value="{{$busid}}" class="form-control" readonly><br>

										<b><label>Driver: </label></b>
										<input type="tect" name="driver" value="{{$drivername}}" class="form-control" readonly><br>

										<b><label>Supervisor:</label></b>
										<input type="tect" name="supervisor" value="{{$supervisorname}}" class="form-control" readonly><br>

										<b><label>Line:</label></b>
										<input type="tect" name="line" value="{{$line}}" class="form-control" readonly><br>

										<button type="submit" class="btn btn-primary"><b>Delete</b></button>
										<button id="cancelBtn" class="btn btn-danger"><b>Cancel</b></button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif

		</div>
	</div>
	<script type="text/javascript">
		$("#cancelBtn").click(function(event) {
			window.location.href="{{url('busDelete')}}";
		});
	</script>
</body>
</html>


