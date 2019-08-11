<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Bus Update</title>
</head>
<body background="assets/img/backgrounds/1.jpg">

	@include('import/navbarAdmin')

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Bus</B></h3></div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								<div class="form-group">
									
									<div class="container">
										<div class="panel-body">
											<form action="{{url('busUpdate1')}}" method="post" enctype="multipart/form-data">
												{{ csrf_field() }}
												<B>Bus ID:</B> <input type="text" name="busid">
												<button type="submit" class="btn btn-primary"><B>Search</B></button>
											</form>
										</div>
									</div>

									@if(isset($drivername))
									<div class="panel panel-default">
										<div class="panel-heading"><h3><B>Bus Information</B></h3></div> 
										<div class="panel-body">
											<div class="py-5">
												<div class="container">
													<div class="row">
														<div class="col-md-11">

															<form action="{{ url('updateBus') }}" method="post">
																{{ csrf_field() }}
																<div class="form-group">
																	<label>Bus ID</label></B>
																	<input type="textfield" class="form-control" name="busID" value="{{$busid}}" readonly><br>
																	<label>Driver: {{$drivername}}</label></B>
																	<select id="driver" name="driver" class="form-control" required>
																		<option value="">Select new driver or the same driver</option>
																		@for($i=0;$i<count($driverIds);$i++)
																		<option value="{{$driverIds[$i]}}">{{$driverNames[$i]}}</option>
																		@endfor
																	</select><br>
																	<label>Supervisor:  {{$supervisorname}}</label></B>
																	<select id="supervisor" name="supervisor" class="form-control" required>
																		<option value="">Select new supervisor or the same supervisor</option>
																		@for($j=0;$j<count($supervisorIds);$j++)
																		<option value="{{$supervisorIds[$j]}}">{{$supervisorNames[$j]}}</option>
																		@endfor
																	</select><br>
																	<label>Line:  {{$line}}</label></B>
																	<select class="form-control" name="line" required>
																		<option value="">Select new line or the same line</option>
																		@foreach($liness as $key => $lineValue)
											                            <option value="{{$lineValue['line']}}">{{$lineValue['line']}}</option>
											                            @endforeach
																	</select><br>
																	<input type="hidden" name="driverName" id="driverName" value="">
																	<input type="hidden" name="supervisorName" id="supervisorName" value="">
																	<button id="busBtn" type="submit" class="btn btn-primary"><B>Update</B></button>
																	<button id="cancelBtn" class="btn btn-danger"><B>Cancel</B></button>
																</div>
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
		$("#cancelBtn").click(function(event) {
			window.location.href="{{url('busUpdate')}}";
		});
	</script>
</body>
</html>