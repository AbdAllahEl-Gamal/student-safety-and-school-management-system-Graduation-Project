<html>
<head>
	<?php include 'import/Imports.php'; ?>
	<title>Bus Access</title>
</head>
<body background="assets/img/backgrounds/1.jpg">
	@include('import/navbarAdmin')
	<div class="container">
    <div class="row">
     <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"><B>Access Bus Information</B></h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">	
                <form action="{{url('accessBus')}}" method="post">
                 {{ csrf_field() }}
                 <label>Bus ID:</label></B>
                 <select name="busid" class="form-control" required>
                  <option value="">None</option>
                  @for($i=0;$i<count($busIds);$i++)
                  <option value="{{$busIds[$i]}}">{{$busIds[$i]}}</option>
                  @endfor
                </select><br>
                @for($i=0;$i<count($busIds);$i++)
                <input type="hidden" name="busIds1[]" value="{{$busIds[$i]}}"></input>
                @endfor

                <button type="submit" class="btn btn-primary"><B>Search</B></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container">
  <div class="row">

    @if(isset($supervisorName))
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"><B>Bus Information</B></h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3 col-lg-3 " align="center"> <img width="200" height="200" alt="Bus" src="pic/bus.jpg" class="img-circle img-responsive"> </div>
          <div class=" col-md-9 col-lg-9 "> 
            <table class="table table-user-information">
              <tbody>
                <tr>
                  <td>Supervisor Name:</td>
                  <td>{{$supervisorName}}</td>
                </tr>
                <tr>
                  <td>Supervisor Phone Number:</td>
                  <td>{{$supervisorPhoneNumber}}</td>
                </tr>
                <tr>
                  <td>Driver Name:</td>
                  <td>{{$driverName}}</td>
                </tr>                
                <tr>
                  <tr>
                    <td>Driver Phone Number:</td>
                    <td>{{$driverPhoneNumber}}</td>
                  </tr>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"><B>Students</B></h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="panel-body">
            <div class="row">
             <div class="col-md-12">	
              <center>					
                <table class="table">
                  <thead>
                   <tr class="row">
                     <th class="col-md-5">Name</th>
                     <th class="col-md-3">Class</th>
                     <th class="col-md-4">Parent Phone Number</th>
                   </tr>
                 </thead>
                 <tbody>
                  @for($i=0;$i<count($names);$i++) 
                  <tr class="row">
                   <td class="col-md-5">{{$names[$i]}}</td>
                   <td class="col-md-3">{{$classes[$i]}}</td>
                   <td class="col-md-4">{{$parentNumbers[$i]}}</td>
                 </tr> 
                 @endfor
               </tbody>
             </table>
           </center>
         </div>
       </div>
     </div>
   </div>
 </div>

@endif
</body>
</html>