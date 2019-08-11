<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Library</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	
	<div class="container">
		
		@if((!isset($sheets))||($sheets=='No files found'))
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Library</B></h3></div>
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
								<form action="{{ url('loadSheetsAdmin') }}" method="post">
									{{ csrf_field() }}

									<div class="col-md-12">
										<div class="form-group {{ $errors->has('class') ? 'has-error' : '' }}">
											<B><label>class</label></B><br>
											<select name="classess" class="form-control">
												<option value="">None</option>
												@foreach($classess as $key => $classValue)
												<option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
											<B><label>Subject</label></B><br>
											<select name="subject" class="form-control">
												<option value="">None</option>
												@foreach($subjectss as $key => $subjectValue)
												<option value="{{$subjectValue['subject']}}">{{$subjectValue['subject']}}</option>
												@endforeach
											</select>
										</div>
										<button type="submit" class="btn btn-primary"><B>Submit</B></button>
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
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Files</B></h3></div> 
			<div class="panel-body">
				<div class="row">
					<ul>
						@foreach($sheets as $key => $sheet)
						<form method="post" action="{{url('sheetDelete')}}">
							{{ csrf_field() }}
							<li>
								<a class="btn btn-primary" download="{{$sheet['name']}}" href="data:application/pdf;base64,{{$sheet['sheet']}}" title='Download pdf document'><span class="glyphicon glyphicon-download"></span> Download {{$sheet['name']}}</a>
								<input type="hidden" name="sheetId" value="{{$key}}">
								<input type="hidden" name="classId" value="{{$classId}}">
								<input type="hidden" name="subjectId" value="{{$subjectId}}">
								<button class="btn btn-danger" type="submit">Delete</button>
							</li>
						</form><br><br>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		@endif
	</div>		
</body>
</html>