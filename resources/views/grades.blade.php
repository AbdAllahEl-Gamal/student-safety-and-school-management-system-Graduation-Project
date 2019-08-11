<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<style>input.ng-invalid{border:1px solid red;}</style>
	<title>Grades</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarTeacher')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Manage Grades</B></h3></div>
			<div class="panel-body">
				<div class="py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								<form method="post" action="{{ url('returnGrades') }}">
									{{ csrf_field() }}
									<div class="form-group">
										<B><label>Class</label></B><br>
										<select class="form-control" name="class" required>
											<option value="">None</option>
											@foreach($classess as $key => $classValue)
											<option value="{{$classValue['class']}}">{{$classValue['class']}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<B><label>Subject</label></B><br>
										<select class="form-control" name="subject" required>
											<option value="">None</option>
											@foreach($subjectss as $key => $subjectValue)
											<option value="{{$subjectValue['subject']}}">{{$subjectValue['subject']}}</option>
											@endforeach
										</select>
										
									</div>
									<div class="form-group">
										<B><label>Grade</label></B><br>
										<select class="form-control" name="gradeType" required>
											<option value="">None</option>
											<option value="quizzes">Quiz</option>
											<option value="midterm">Midterm</option>
											<option value="final">Final</option>
										</select>
										
									</div>
									<button type="submit" class="btn btn-primary"><B>Search</B></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
