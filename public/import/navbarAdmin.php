<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('admin') }}"><img src="pic/1.png" width="30" height="30"></a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="{{ url('employee') }}">Employee</a></li>
			<li><a href="{{ url('parent') }}">Parent</a></li>
			<li><a href="{{ url('student') }}">Student</a></li>
			<li><a href="{{ url('notification') }}">Send Notification</a></li>
			<li><a href="{{ url('timetable') }}">Upload Timetable</a></li>
		</ul>
	</div>
</nav>