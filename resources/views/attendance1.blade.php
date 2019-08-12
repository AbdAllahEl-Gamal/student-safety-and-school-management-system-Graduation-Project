<!DOCTYPE html>
<html>
<head>
	<?php include 'import/Imports.php'; ?>
  <title>Attendance</title>
</head>
<body>
@include('import/navbarTeacher')
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading"><h3><B>Take Attendance</B></h3></div>
      <div class="panel-body">
        <div class="py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-lg-9">
                <form method="post" action="{{ url('insertAttend') }}">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-lg-5">
                      <b><label>Names</label></b>
                    </div>
                    <div class="col-lg-5">
                      <b><label>Status</label></b>
                    </div>
                  </div> 
                  @for($i=0;$i<count($names);$i++)
                  <div class="row">
                    <div class="col-lg-5">
                      <b><label>{{$names[$i]}}</label></b>
                    </div>
                    <div class="col-lg-5">
                      <select name="status[]" required>
                        <option value="">None</option>
                        <option value="true">Attend</option>
                        <option value="false">Absent</option>
                      </select>
                      <input type="hidden" name="ids[]" value="{{$ids[$i]}}">
                    </div>
                  </div> 
                  @endfor
                  <div class="col-xs-6">
                    <br><br><button type="submit" class="btn btn-primary"><b>Submit</b></button>
                    <input type="hidden" name="period" value="{{$period}}">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>