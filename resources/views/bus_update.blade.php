<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Bus Update</title>
</head>
<body background="assets/img/backgrounds/1.jpg">

	@include('import/navbarAdmin')

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Bus</b></h3></div>
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
												<b>Bus ID:</b> <input type="text" name="busid">
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

															<form action="{{ url('updateBus') }}" method="post">
																{{ csrf_field() }}
																<div class="form-group">
																	<b><label>Bus ID</label></b>
																	<input type="textfield" class="form-control" name="busID" value="{{$busid}}" readonly><br>
																	<b><label>Driver: {{$drivername}}</label></b>
																	<select id="driver" name="driver" class="form-control" required>
																		<option value="">Select new driver or the same driver</option>
																		@for($i=0;$i<count($driverIds);$i++)
																		<option value="{{$driverIds[$i]}}">{{$driverNames[$i]}}</option>
																		@endfor
																	</select><br>
																	<b><label>Supervisor:  {{$supervisorname}}</label></b>
																	<select id="supervisor" name="supervisor" class="form-control" required>
																		<option value="">Select new supervisor or the same supervisor</option>
																		@for($j=0;$j<count($supervisorIds);$j++)
																		<option value="{{$supervisorIds[$j]}}">{{$supervisorNames[$j]}}</option>
																		@endfor
																	</select><br>
																	<b><label>Line:  {{$line}}</label></b>
																	<select class="form-control" name="line" required>
																		<option value="">Select new line or the same line</option>
																		@foreach($liness as $key => $lineValue)
											                            <option value="{{$lineValue['line']}}">{{$lineValue['line']}}</option>
											                            @endforeach
																	</select><br>
																	<input type="hidden" name="driverName" id="driverName" value="">
																	<input type="hidden" name="supervisorName" id="supervisorName" value="">
																	<button id="busBtn" type="submit" class="btn btn-primary"><b>Update</b></button>
																	<button id="cancelBtn" class="btn btn-danger"><b>Cancel</b></button>
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