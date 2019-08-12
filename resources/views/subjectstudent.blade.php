<html>
<head>
	<title>Subject to Student</title>
	<?php include 'import/Imports.php'; ?>
	<link href="style/jquery.lwMultiSelect.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/jquery.lwMultiSelect.js"></script>
</head>
<body>
	<div class="container">
	
	<form action="{{url('addSubjectStudent')}}" method="post">
		{{ csrf_field() }}
		<select id="defaults" name="subject" multiple="multiple">
			<option value="Arabic">Arabic</option>
			<option value="English">English</option>
			<option value="Math">Math</option>
		</select>
		<button type="submit" class="btn btn-primary"><b>Submit</b></button>
	</form>

	</div>
	<script>
		$('#defaults').lwMultiSelect();
	</script>
</body>
</html>