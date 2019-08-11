<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Employee page</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h3><B>Employee</B></h3></div>
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
						<li class={{Request::is('employee')?"active":""}}><a data-toggle="pill" href="#insert"><B>Insert</B></a></li> 
						<li class={{Request::is('employeeUpdate')?"active":""}}><a data-toggle="pill" href="#update"><B>Update</B></a></li>
						<li class={{Request::is('employeeDelete')?"active":""}}><a data-toggle="pill" href="#delete"><B>Delete</B></a></li>
					</ul>
				</div>
				<div class="col-lg-4"></div>
			</div>

			<div class="tab-content">

				<div id="insert" class="tab-pane fade in {{Request::is('employee')?"active":""}}">
					<div class="panel-body">
						<div class="py-5">
							<div class="container">
								<div class="row">
									<div class="col-md-11">

										<form action="{{ url('insertEmployee') }} " method="post" enctype="multipart/form-data" files="true">
											{{ csrf_field() }}

											<div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
												<B><label>Full name</label></B> 
												<input type="text" name="fullname" id="Empname" pattern="[A-Z\sa-z]+" value="{{ old('fullname') }}" class="form-control" placeholder="Abdallah">
											</div>

											<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
												<B><label>Gender</label></B><br>
												<input type="radio" name="gender" value="Male"> <B>Male</B>&nbsp;&nbsp;&nbsp;
												<input type="radio" name="gender" value="Female"> <B>Female</B>
											</div>

											<div class="form-group {{ $errors->has('dateofbirth') ? 'has-error' : '' }}">
												<B><label>Date of birth</label></B>
												<input type="date" name="dateofbirth" id="Dateofbirth" value="{{ old('dateofbirth') }}" class="form-control">
											</div>

											<div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
												<B><label>Position</label></B><br>
												<select name="position" id="Emppos" class="form-control">
													<option value="">None</option>
													<option value="admin">Admin</option>
													<option value="teacher">Teacher</option>
													<option value="bus supervisor">Bus Supervisor</option>
													<option value="driver">Driver</option>
												</select>
											</div>

											<div class="form-group {{ $errors->has('phonenumber') ? 'has-error' : '' }}">
												<B><label>Phone number</label></B> 
												<input type="text" name="phonenumber" id="Emppn" pattern="[0-9]+" value="{{ old('phonenumber') }}" class="form-control" placeholder="+20xxxxxxxxxx" >
											</div>

											<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
												<B><label for="">Email ID</label></B> 
												<input type="email" name="email" id="Empemail" value="{{ old('email') }}" class="form-control" placeholder="Employee@example.com" >

											</div>

											<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
												<B><label for="">Password</label></B> 
												<input type="password" name="password" id="Emppass" class="form-control" placeholder="********" >
											</div>

											<div class="form-group">
												<B><label>Upload employee photo</label></B>
												<input type="file" name="employeephoto" id="file">
											</div>
											<button type="submit" class="btn btn-primary"><B>Submit</B></button>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="update" class="tab-pane fade in {{Request::is('employeeUpdate')?"active":""}}">

					<div class="container">
						<div class="panel-body">
							<form action="{{url('employeeUpdate')}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<B>Employee ID:</B> <input type="text" name="employeeid">
								<button type="submit" class="btn btn-primary"><B>Search</B></button>
							</form>
						</div>
					</div>

					@if(isset($name))
					<div class="panel panel-default">
						<div class="panel-heading"><h3><B>Employee Information</B></h3></div> 
						<div class="panel-body">
							<div class="py-5">
								<div class="container">
									<div class="row">
										<div class="col-md-11">

											<form action="{{url('employeeUpdate1')}}" method="post" enctype="multipart/form-data">
												{{ csrf_field() }}

												<input type="hidden" name="employeeid2" value="{{$employeeid}}">

												<div class="form-group">
													<B><label>Full name</label></B> 
													<input type="text" name="fullname" value="{{$name}}" class="form-control">
												</div>

												<div class="form-group">
													<B><label>Position</label></B> 
													
													<select name="position" id="Emppos" class="form-control">
														<option value="">None</option>
														<option value="admin" {{$position=='admin'?"selected":""}}>Admin</option>
														<option value="teacher" {{$position=='teacher'?"selected":""}}>Teacher</option>
														<option value="bus supervisor" {{$position=='bus supervisor'?"selected":""}}>Bus Supervisor</option>
														<option value="driver" {{$position=='driver'?"selected":""}}>Driver</option>
													</select>
												</div>
												<div class="form-group">
													<B><label>Email ID</label></B> 
													<input type="email" name="email" value="{{$email}}" class="form-control">
												</div>
                                                <div class="form-group">
												    <B><label>Date of birth</label></B>
												    <input type="date" name="dateofbirth" value="{{$dateofbirth}}" class="form-control">
                                                </div>
                                                <div class="form-group">
												    <B><label>Password</label></B>
												    <input type="password" name="password" value="{{$password}}" class="form-control">
                                                </div>												
												<button type="submit" class="btn btn-primary"><B>Update</B></button>
												<button type="submit" formaction="{{url('employeeCUpdate1')}}" class="btn btn-primary"><B>Cancel</B></button>
											</form>
                                            <form action="{{url('employeeCUpdate1')}}" method="post" enctype="multipart/form-data">
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

				<div id="delete" class="tab-pane fade in {{Request::is('employeeDelete')?"active":""}}">

					<div class="container">
						<div class="panel-body">
							<form action="{{url('employeeDelete')}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<B>Employee ID:</B> <input type="text" name="employeeid">
								<button type="submit" class="btn btn-primary"><B>Search</B></button>
							</form>
						</div>
					</div>

					@if(isset($namee))
					<div class="panel panel-default">
						<div class="panel-heading"><h3><B>Employee Information</B></h3></div> 
						<div class="panel-body">
							<div class="py-5">
								<div class="container">
									<div class="row">
										<div class="col-md-11">
											<form action="{{url('employeeDelete1')}}" method="post" enctype="multipart/form-data">
												{{ csrf_field() }}
												<input type="hidden" name="employeeid2" value="{{$employeeid}}">

												<div class="form-group">
													<B><label>Full name:</label></B>
													<B><label>{{$namee}}</label></B>					
												</div>

												<div class="form-group">
													<B><label>Gender:</label></B>
													<B><label>{{$gender}}</label></B>					
												</div>

												<div class="form-group">
													<B><label>Date of birth:</label></B> 
													<B><label>{{$dateofbirth}}</label></B>
												</div>

												<div class="form-group">
													<B><label>Position:</label></B> 
													<B><label>{{$position}}</label></B>
												</div>

												<div class="form-group">
													<B><label>Email ID:</label></B> 
													<B><label>{{$email}}</label></B>
												</div>

												<div class="form-group">
													<B><label>Password:</label></B> 
													<B><label>{{$password}}</label></B>
												</div>
												<button type="submit" class="btn btn-primary"><B>Delete</B></button>
												<button type="submit" formaction="{{url('employeeCDelete1')}}" class="btn btn-primary"><B>Cancel</B></button>
											</form>
											<form action="{{url('employeeCDelete1')}}" method="post" enctype="multipart/form-data">
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