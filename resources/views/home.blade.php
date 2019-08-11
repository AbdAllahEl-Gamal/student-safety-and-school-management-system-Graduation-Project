
<html lang="en">
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Home Page</title>
</head>
<body>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<font color="black"><center><h4><B>Home page</B></h4></center></font>
			</div>
		</div>
	</div>
	<div class="top-content">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="form-box">
							<div class="form-top">
								<div class="form-top-left">
									<h3><B>Login</B></h3>
									<p>Enter username and password to log on:</p>
								</div>
								<div class="form-top-right">
									<i class="fa fa-key"></i>
								</div>
							</div>
							<div class="form-bottom">
								<form role="form" class="login-form" method="post" action="{{url('login')}}">
									@if (count($errors)>0)
									<ul>
										@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul>
									@endif
									{{ csrf_field() }}
									<div class="form-group">
										<label class="sr-only" for="form-username">Username</label>
										<input type="text" name="form-username" placeholder="Username" class="form-username form-control" required>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-password">Password</label>
										<input name="form-password" placeholder="Password" class="form-password form-control" type="password" required>
									</div>
									<button type="submit" class="btn"><B>Sign in!</B></button>
									<a href="{{ url('forgetPassword') }}">Forget Password ?</a>
								</form>
							</div>

						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="form-box">
								<div class="form-top">
									<div class="form-top-left">
										<h3><B>Login Parent</B></h3>
										<p>Enter Parent username and password to log on:</p>
									</div>
									<div class="form-top-right">
										<i class="fa fa-key"></i>
									</div>
								</div>
								<div class="form-bottom">
									<form role="form" class="login-form" method="post" action="{{url('loginParent')}}">
										@if (count($errors)>0)
										<ul>
											@foreach($errors->all() as $error)
											<li>{{ $error }}</li>
											@endforeach
										</ul>
										@endif
										{{ csrf_field() }}
										<div class="form-group">
											<label class="sr-only" for="form-username2">Parent Username</label>
											<input type="text" name="form-username2" placeholder="Username" class="form-username form-control" required>
										</div>
										<div class="form-group">
											<label class="sr-only" for="form-password2">Parent Password</label>
											<input name="form-password2" placeholder="Password" class="form-password form-control" type="password" required>
										</div>
										<button type="submit" class="btn"><B>Sign in!</B></button>
										<a href="{{ url('forgetPassword') }}">Forget Password ?</a>
									</form>
								</div>

							</div>					
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>