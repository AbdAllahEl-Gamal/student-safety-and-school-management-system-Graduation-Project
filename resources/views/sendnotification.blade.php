<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Send notifications</title>
</head>
<body ng-app="" background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
	<div  class="panel panel-default">
	<div class="panel-heading"><h3><B>Send Notification</B></h3></div>
	@if (count($errors)>0)
	<ul>
		@foreach($errors->all() as $error)
		<li class="alert alert-success">{{ $error }}</li>
		@endforeach
	</ul>
	@endif
    
	<ul class="nav nav-pills"  style="padding-left: 300px" >
    <li class="active"><a data-toggle="pill" href="#singleDevice"><B>Single Device</B></a></li> 
    <li><a data-toggle="pill" href="#multiDevice"><B>Multi Devices</B></a></li>
    <li><a data-toggle="pill" href="#singleTopic"><B>Single Topic</B></a></li>
    <li><a data-toggle="pill" href="#multiTopic"><B>Multi Topics</B></a></li>
    </ul>


	<div class="tab-content">
            <div id="singleDevice" class="tab-pane fade in active">
				<div class="panel-body">
					<div class="py-5">
						<div class="container">
							<div class="row">
								<div class="col-md-11">
									<form method="post" action="{{ url('NotificationSingleDevice') }}">
												{{ csrf_field() }}
										    <div class="form-group">
											  <label for="usr">Parent phone number</label>
											  <input type="text" class="form-control" name="tokenID">
											</div>
											<div class="form-group">
											  <label for="usr">Title</label>
											  <input type="text" class="form-control" name="title_notification">
											</div>
											<div class="form-group">
												<label for="comment">Message Body</label>
												<textarea class="form-control" rows="5" name="msg_body"> </textarea>
											</div>
										<button type="submit" class="btn btn-primary"><B>Send Notification</B></button>
									</form>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		
	        <div id="multiDevice" class="tab-pane fade">
				<div class="panel-body">
					<div class="py-5">
						<div class="container">
							<div class="row">
								<div class="col-md-11">
									<form method="post" action="{{ url('NotificationMultiDevice') }}">
										{{ csrf_field() }}
										<div class="form-group">
											 <label for="usr">Parents phone numbers</label>
											 <input type="text" class="form-control" name="tokenArray">
										</div>
										<div class="form-group">
										  	<label for="usr">Title</label>
											 <input type="text" class="form-control" name="title_notification">
										</div>
										<div class="form-group">
											<label for="comment">Message Body</label>
											<textarea class="form-control" rows="5" name="msg_body"> </textarea>
										</div>
										<button type="submit" class="btn btn-primary"><B>Send Notification</B></button>
									</form>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	

		
	        <div id="singleTopic" class="tab-pane fade">
				<div class="panel-body">
					<div class="py-5">
						<div class="container">
							<div class="row">
								<div class="col-md-11">
									<form method="post" action="{{ url('NotificationSingleTopic') }}">
										{{ csrf_field() }}
										<div class="form-group">
											 <label for="usr">Topic</label>
											 <input type="text" class="form-control" name="topicID">
										</div>
										<div class="form-group">
										  	<label for="usr">Title</label>
											 <input type="text" class="form-control" name="title_notification">
										</div>
										<div class="form-group">
											<label for="comment">Message Body</label>
											<textarea class="form-control" rows="5" name="msg_body"> </textarea>
										</div>
										<button type="submit" class="btn btn-primary"><B>Send Notification</B></button>
									</form>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		
	        <div id="multiTopic" class="tab-pane fade">
				<div class="panel-body">
					<div class="py-5">
						<div class="container">
							<div class="row">
								<div class="col-md-11">
									<form method="post" action="{{ url('NotificationMultiTopic') }}">
										{{ csrf_field() }}
										<div class="form-group">
											 <label for="usr">Topic</label>
											 <input type="text" class="form-control" name="topicArray">
										</div>
										<div class="form-group">
										  	<label for="usr">Title</label>
											 <input type="text" class="form-control" name="title_notification">
										</div>
										<div class="form-group">
											<label for="comment">Message Body</label>
											<textarea class="form-control" rows="5" name="msg_body"> </textarea>
										</div>
										<button type="submit" class="btn btn-primary"><B>Send Notification</B></button>
									</form>	
								</div>
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