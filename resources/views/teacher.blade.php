<html lang="en">
<head>
    <?php include 'import/Imports.php'; ?>
    <title>Teacher</title>
</head>
<body >
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>Teacher</strong></h1>
                    </div>
                </div><br><br>
                <div class="row">
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary btn-lg active" href="{{ url('attendance') }}" role="button">Take Attendance</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('grades') }}" role="button">Manage Grades</a>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary btn-lg active" href="{{ url('studentAccess') }}" role="button">Student Access</a>
                        <a class="btn btn-primary btn-lg active" href="{{ url('answerQuestions') }}" role="button">Answer Questions</a>
                    </div>
                </div>
                <br><br>
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