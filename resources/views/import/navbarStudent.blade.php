<nav class="navbar navbar-expand-md navbar-light bg-primary">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><img src="pic/1.png" width="30" height="30"></a>
		</div>
		<ul class="nav navbar-nav">			
		    <li><a href="{{ url('studentProfile').'/'.session('id') }}">Profile</a></li>
			<li><a href="{{ url('library') }}">Library</a></li>
			<li><a href="{{ url('askyourteacher') }}">Ask Your Teacher</a></li>
			<li><a href="{{ url('logout') }}">Logout</a></li>
	    </ul>
	    </div>
</nav>