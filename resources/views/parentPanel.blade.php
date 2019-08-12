<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Parent Portal</title>
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
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarParent')
 <div class="container">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Children</b></h3>
    </div>
    @foreach($children as $key => $child)

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title"><b>{{$child['name']}}</b></h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3 col-lg-3 " align="center"> <a href="{{url('studentProfile/'.$key)}}"><img alt="Student Picture" src="data:image/png;base64,{{$child['pic']}}" class="img-circle img-responsive"></a> </div>
              <div class=" col-md-9 col-lg-9 "> 
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td>Class:</td>
                      <td>{{$child['class']}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
</body>
</html>