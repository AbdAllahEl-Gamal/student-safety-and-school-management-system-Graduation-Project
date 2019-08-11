<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Upload Sheets</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Upload Sheet</B></h3></div>
			<div class="panel-body">
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
							<form action="{{ url('uploadSheet') }} " method="post" enctype="multipart/form-data" files="true">
								{{ csrf_field() }}
								<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
									<div class="form-group">
										<B><label>Subject</label></B><br>
										<select class="form-control" name="subject" required>
											<option value="">None</option>
											@foreach($subjectss as $key => $subjectValue)
											<option value="{{$subjectValue['subject']}}">{{$subjectValue['subject']}}</option>
											@endforeach
										</select>
										
									</div>
								</div>
								<div class="form-group {{ $errors->has('class') ? 'has-error' : '' }}">
									<div class="form-group">
										<B><label>Class</label></B><br>
										<select class="form-control" name="class" required>
											<option value="">None</option>
											@foreach($classess as $key => $classValue)
											<option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
											@endforeach
										</select>										
									</div>
								</div>
								<div class="form-group {{ $errors->has('sheet') ? 'has-error' : '' }}">
									<B><label>Upload Sheet</label></B><br>
									<input type="file" name="sheet" id="file">
								</div>
								<button type="submit" class="btn btn-primary"><B>Submit</B></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>