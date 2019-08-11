

<html lang="en">
<head>
  <?php include 'import/Imports.php'; ?>
  <title>forget password</title>
</head>
<body>
  <div class="container">

    <div class="panel-heading"></div>
    <div class="row">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="text-center">
                <h3><i class="fa fa-lock fa-4x"></i></h3>
                <h3><B>Forget Password ?</B></h3>
                <p>You can reset your password here.</p>
                <div class="panel-body">

                  <form method="post" action="{{url('forgetPass')}}">
                    {{ csrf_field() }}

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone color-blue"></i></span>
                        <input name="phoneInput" placeholder="Phone Number " class="form-control" type="text" oninvalid="setCustomValidity('Please enter your phone!')" required>
                      </div>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                        <input name="emailInput" placeholder="Email Address" class="form-control" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required>
                      </div>  
                    </div>
                    <div class="form-group">
                      <input class="btn btn-lg btn-primary btn-block" value="Send My Password" type="submit">
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>