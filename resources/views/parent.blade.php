<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Parent page</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><b>Parent</b></h3></div>
			@if(count($errors)>0)
			<ul>
				@foreach($errors->all() as $error)
				<li class="alert alert-danger">{{$error}}</li>
				@endforeach
			</ul>
			@endif
			<div class="row">
				<div class="col-lg-5"></div>
				<div class="col-lg-4">
					<ul class="nav nav-pills">
						<li class={{Request::is('parent')?"active":""}}><a data-toggle="pill" href="#insert"><b>Insert</b></a></li> 
						<li class={{Request::is('parentUpdate')?"active":""}}><a data-toggle="pill" href="#update"><b>Update</b></a></li>
						<li class={{Request::is('parentDelete')?"active":""}}><a data-toggle="pill" href="#delete"><b>Delete</b></a></li>
					</ul>
				</div>
				<div class="col-md-4"></div>
			</div>
			
			<div class="tab-content">
				<div id="insert" class="tab-pane fade in {{Request::is('parent')?"active":""}}">
					<div class="panel-body">
						<div class="py-5">
							<div class="container">
								<div class="row">
									<div class="col-md-11">

										<form action="{{ url('insertParent') }} " method="post">
											{{ csrf_field() }}
											<div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
												<b><label>Full name</label></b>
												<input type="text" name="fullname" pattern="[A-Z\sa-z]+" class="form-control" placeholder="Parent name">
											</div>
											<div class="form-group {{ $errors->has('phonenumber') ? 'has-error' : '' }}">
												<b><label>Phone number</label></b> 
												<input type="text" name="phonenumber" pattern="[0-9]+" class="form-control" placeholder="+20xxxxxxxxxx">
											</div>
											<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
												<b><label>Email ID</label></b> 
												<input type="email" name="email" class="form-control" placeholder="Parent@example.com">
											</div>
											<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
												<b><label>Password</label></b> 
												<input type="password" name="password"  class="form-control" placeholder="********">
											</div>
											<button type="submit" class="btn btn-primary"><b>Submit</b></button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="update" class="tab-pane fade in {{Request::is('parentUpdate')?"active":""}}">

					<div class="container">
						<div class="panel-body">
							<form action="{{url('parentUpdate')}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<b>Parent ID:</b> <input type="text" name="parentid">
								<button type="submit" class="btn btn-primary"><b>Search</b></button>
							</form>
						</div>
					</div>

					@if(isset($name))
					<div class="panel panel-default">
						<div class="panel-heading"><h3><b>Parent Information</b></h3></div> 
						<div class="panel-body">
							<div class="py-5">
								<div class="container">
									<div class="row">
										<div class="col-md-11">

											<form action="{{url('parentUpdate1')}}" method="post" enctype="multipart/form-data">
												{{ csrf_field() }}

												<input type="hidden" name="parentid2" value="{{$parentid}}">

												<div class="form-group">
													<b><label>Full name</label></b> 
													<input type="text" name="fullname" value="{{$name}}" class="form-control">
												</div>

												<div class="form-group">
													<b><label>Email ID</label></b> 
													<input type="email" name="email" value="{{$email}}" class="form-control">
												</div>
												
												<div class="form-group">
													<b><label>Password</label></b> 
													<input type="password" name="password" value="{{$password}}" class="form-control">
												</div>
												<button type="submit" class="btn btn-primary"><b>Update</b></button>
												<button type="submit" formaction="{{url('parentCUpdate1')}}" class="btn btn-primary"><b>Cancel</b></button>
											</form>
                                            <form action="{{url('parentCUpdate1')}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
											</form>											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>

				<div id="delete" class="tab-pane fade in {{Request::is('parentDelete')?"active":""}}">

					<div class="container">
						<div class="panel-body">
							<form action="{{url('parentDelete')}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<b>Parent ID:</b> <input type="text" name="parentid">
								<button type="submit" class="btn btn-primary"><b>Search</b></button>
							</form>
						</div>
					</div>

					@if(isset($namee))
					<div class="panel panel-default">
						<div class="panel-heading"><h3><b>Parent Information</b></h3></div> 
						<div class="panel-body">
							<div class="py-5">
								<div class="container">
									<div class="row">
										<div class="col-md-11">
											<form action="{{url('parentDelete1')}}" method="post" enctype="multipart/form-data">
												{{ csrf_field() }}
												<input type="hidden" name="parentid2" value="{{$parentid}}">

												<div class="form-group">
													<b><label>Full name:</label></b>
													<b><label>{{$namee}}</label></b>					
												</div>

												<div class="form-group">
													<b><label>Email ID:</label></b> 
													<b><label>{{$email}}</label></b>
												</div>

												<div class="form-group">
													<b><label>Password:</label></b> 
													<b><label>{{$password}}</label></b>
												</div>
												<button type="submit" class="btn btn-primary"><b>Delete</b></button>
												<button type="submit" formaction="{{url('parentCDelete1')}}" class="btn btn-primary"><b>Cancel</b></button>
											</form>
											<form action="{{url('parentCDelete1')}}" method="post" enctype="multipart/form-data">
											{{ csrf_field() }}
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
</body>
</html>