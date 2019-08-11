<html lang="en">
<head>
    <?php include 'import/Imports.php'; ?>
    <title>Admin</title>
</head>
<body >
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>Admin</strong></h1>
                    </div>
                </div><br><br>
                <div class="row">
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary btn-lg active" href="{{ url('employee') }}" role="button">Employee</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('parent') }}" role="button">Parent</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('student') }}" role="button">Student</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('studentAccess') }}" role="button">Student Access</a>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary btn-lg active" href="{{ url('busAdd') }}" role="button">Add Bus</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('studentbus') }}" role="button">Assign Seat</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('bustracking') }}" role="button">Bus Tracking</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('busAccess') }}" role="button">Bus Access</a>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary btn-lg active" href="{{ url('timetable') }}" role="button">Upload Timetable</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('sheet') }}" role="button">Upload Sheet</a>
						<a class="btn btn-primary btn-lg active" href="{{ url('updateStudentPassword') }}" role="button">Update Student Password</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('notification') }}" role="button">Send Notification</a>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="btn-group btn-group-justified">
                       <a class="btn btn-primary btn-lg active" href="{{ url('teachersubjectclass') }}" role="button">Teacher Management</a>
                       <a class="btn btn-primary btn-lg active" href="{{ url('class') }}" role="button">Class Management</a>
                       <a class="btn btn-primary btn-lg active" href="{{ url('subject') }}" role="button">Subject Management</a>
                       <a class="btn btn-primary btn-lg active" href="{{ url('assignsubjects') }}" role="button">Assign Subjects</a>
                   </div>
               </div>
               <br><br>
               <div class="row">
                <div class="btn-group btn-group-justified">
                    <a class="btn btn-danger btn-lg active" href="{{ url('logout') }}" role="button">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
 <div class="container">
  <div class="row">
  </div>
</div>
</footer>
</body>
</html>