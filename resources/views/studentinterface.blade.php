<html>
<head>
	<title>Profile</title>
	<?php include 'import/Imports.php'; ?>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .user-row {
    margin-bottom: 14px;
  }

  .user-row:last-child {
    margin-bottom: 0;
  }

  .dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
  }

  .dropdown-user:hover {
    cursor: pointer;
  }

  .table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
  }

  .table-user-information > tbody > tr:first-child {
    border-top: 0;
  }


  .table-user-information > tbody > tr > td {
    border-top: 0;
  }
  .toppad
  {margin-top:20px;
  }

</style>
</head>
<body >
	@include('import/navbarParent')
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title"><B>{{$name}}</B></h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3 col-lg-3 " align="center"> <img alt="Student Picture" src="{{$pic}}" class="img-circle img-responsive"> </div>
              <div class=" col-md-9 col-lg-9 "> 
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td>Class:</td>
                      <td>{{$class}}</td>
                    </tr>
                    <tr>
                      <td>Parent Phone Number:</td>
                      <td>{{$parentPhone}}</td>
                    </tr>
                    <tr>
                      <td>Bus Number:</td>
                      <td>{{$bus}}</td>
                    </tr>                
                    <tr>
                      <tr>
                        <td>Supervisor Name:</td>
                        <td>{{$supername}}</td>
                      </tr>
                      <tr>
                        <td>Supervisor Phone Number:</td>
                        <td>{{$superphone}}</td>
                      </tr>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <div class="container">
   <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title"><B>Timetable</B></h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="panel-body">
          <div class="row">
           <div class="col-md-12">
             <img src="{{$timetablepic}}">
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="container">
  <div class="panel panel-info">
    <div class="panel-heading"><h3><B>Grades</B></h3></div> 
    <div class="panel-body">
      <div class="row">
        @if($subjects)
        @foreach($subjects as $key => $value)
        <div class="col-md-4">
          <table class="table table-striped">
            <thead align="center"><b><h3>{{$key}}</h3></b></thead>
            @foreach($value as $nkey => $nvalue)
            <tr align="center">
              <td>{{$nkey}}</td>
              <td>{{$nvalue}}</td>
            </tr>
            @endforeach
          </table>
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="panel panel-info">
    <div class="panel-heading"><h3><B>Attendance</B></h3></div> 
    <div class="panel-body">
      <div class="row">
        @if($attendance)
        @foreach($attendance as $key => $value)
        <div class='col-md-4'>
          <table class="table table-striped">
            <thead align='center'><b><h3>{{$key}}</h3></b></thead>
            <?php ksort($value)?>
            @foreach($value as $nkey => $nvalue)
            <tr align='center'>
              <td>{{$nkey}}</td>
              <td>{{$nvalue}}</td>
            </tr>
            @endforeach
          </table>
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>