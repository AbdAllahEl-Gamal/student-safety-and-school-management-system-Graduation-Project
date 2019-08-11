<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('teacher') }}"><img src="pic/1.png" width="30" height="30"></a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="{{ url('profile') }}">Profile</a></li>
			<li><a href="{{ url('attendance') }}">Take Attendance</a></li>
			<li><a href="{{ url('grades') }}">Grades</a></li>
			<li><a href="{{ url('studentAccess') }}">Student Access</a></li>
			<li><a href="{{ url('logout') }}">Logout</a></li>
		</ul>
	</div>
</nav>