<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="{{ url('admin') }}"><img src="pic/1.png" width="30" height="30"></a>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{ url('employee') }}"><font color="black">Employee</font></a></li>
						<li><a href="{{ url('parent') }}"><font color="black">Parent</font></a></li>
						<li><a href="{{ url('student') }}"><font color="black">Student</font></a></li>
						<li><a href="{{ url('updateStudentPassword') }}"><font color="black">Update Student Password</font></a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Management<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{ url('teachersubjectclass') }}"><font color="black">Teacher</font></a></li>
						<li><a href="{{ url('class') }}"><font color="black">Class</font></a></li>
						<li><a href="{{ url('subject') }}"><font color="black">Subject</font></a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Upload<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{ url('timetable') }}"><font color="black">Upload Timetable</font></a></li>
						<li><a href="{{ url('sheet') }}"><font color="black">Upload Sheet</font></a></li>
					</ul>
				</li>		
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Bus<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{ url('busAdd') }}"><font color="black">Add</font></a></li>
						<li><a href="{{ url('busUpdate') }}"><font color="black">Update</font></a></li>
						<li><a href="{{ url('busDelete') }}"><font color="black">Delete</font></a></li>
						<li><a href="{{ url('line') }}"><font color="black">Update & Delete line</font></a></li>
						<li><a href="{{ url('studentbus') }}"><font color="black">Assign seat</font></a></li>
						<li><a href="{{ url('busAccess') }}"><font color="black">Information access</font></a></li>
						<li><a href="{{ url('bustracking') }}"><font color="black">Tracking</font></a></li>
					</ul>
				</li>
				<li><a href="{{ url('assignsubjects') }}">Assign Subjects</a></li>			
				<li><a href="{{ url('notification') }}">Send Notification</a></li>
				<li><a href="{{ url('classAccess') }}">Classroom</a></li>
				<li><a href="{{ url('logout') }}">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>