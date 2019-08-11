<!DOCTYPE html>
<html>
<head>
	<?php include 'import/Imports.php'; ?>
  <title>Grades</title>
</head>
<body>
@include('import/navbarTeacher')
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading"><h3><B>Insert Grades</B></h3></div>
      <div class="panel-body">
        <div class="py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-lg-9">
                <form method="post" action="{{ url('insertGrades') }}">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-lg-4">
                      <B><label>Names</label></B>
                    </div>
                    <div class="col-lg-4">
                      <B><label>Grades</label></B>
                    </div>
                  </div>
                  @for($i=0;$i<count($names);$i++)
                  <div class="row">
                    <div class="col-lg-4">
                      <B><label>{{$names[$i]}}</label></B>
                    </div>
                    <div class="col-lg-4">
                     <input name="grades[]" type="number">
                     <input type="hidden" name="ids[]" value="{{$ids[$i]}}">
                   </div>
                 </div>
                 @endfor
                 <div class="col-xs-6">
                  <br><br><button type="submit" class="btn btn-primary"><B>Submit</B></button>
                  <input type="hidden" name="subject" value="{{$subject}}">
                  <input type="hidden" name="gradeType" value="{{$gradeType}}">
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