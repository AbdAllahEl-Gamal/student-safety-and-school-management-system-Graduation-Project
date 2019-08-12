<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Library</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarStudent')
	
	<div class="container">
		
		@if((!isset($sheets))||($sheets=='No files found'))
		<div class="panel panel-info">
	        <div class="panel-heading">
              <h3 class="panel-title"><b>Library</b></h3>
            </div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								@if(isset($sheets)&&$sheets=='No files found')
								<ul>
									<li class="alert alert-danger">No files found</li>
								</ul>
								@endif
								<form action="{{ url('loadSheets') }}" method="post">
									{{ csrf_field() }}

									<div class="col-md-12">
										<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
											<b><label>Subject</label></b><br>
											<select name="subject" class="form-control">
												<option value="">None</option>
												@foreach($subjectss as $key => $subjectValue)
												<option value="{{$key}}">{{$key}}</option>
												@endforeach
											</select>
										</div>
										<button type="submit" class="btn btn-primary"><b>Submit</b></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		@if(isset($sheets)&& $sheets!='No files found')
		<div class="panel panel-info">
	        <div class="panel-heading">
              <h3 class="panel-title"><b>Files</b></h3>
            </div>
			<div class="panel-body">
				<div class="row">
					<ul>
						@foreach($sheets as $sheet)
						<li><a class="btn btn-primary" download="{{$sheet['name']}}" href="data:application/pdf;base64,{{$sheet['sheet']}}" title='Download pdf document'><span class="glyphicon glyphicon-download"></span> Download {{$sheet['name']}}</a></li><br><br>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		@endif
	</div>		
</body>
</html>