<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/templatemo-style.css">
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Homepage</title>
  <style>
  .item {
    width: 1259px;
	height: 85vh;
    background: no-repeat center center scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
</style>
</head>
<body>

 <div id="Employee" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"> &times;</button>
        <h4>Employee Login</h4>
      </div>
      <div class="modal-body">
       <form role="form" class="form-inline" method="post" action="{{url('loginEmployee')}}">
        @if (count($errors)>0)
        <ul>
         @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
       </ul>
       @endif
       {{ csrf_field() }}
       <div class="form-group">
         <label class="sr-only" for="employeeusername">Username</label>
         <input type="text" class="form-control input-sm" placeholder="Username" name="employeeusername" required>
       </div>
       <div class="form-group">  
         <label class="sr-only" for="employeepassword">Password</label>
         <input type="password" class="form-control input-sm" placeholder="Password" name="employeepassword" required>
       </div>
       <div class="checkbox">
         <label>
           <input type="checkbox"> <B>Remember me</B>
         </label>
       </div>
       <div class="form-footer">
        <a href="{{ url('forgetPassword') }}"><B>Forgot your password?</B></a>
      </div>
      <button type="submit" class="btn btn-info btn-xs"><B>Sign in</B></button>
      <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><B>Cancel</B></button>            
    </form>
  </div>
</div>
</div>
</div>

<div id="Parent" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"> &times;</button>
        <h4>Parent Login</h4>
      </div>
      <div class="modal-body">
        <form role="form" class="form-inline" method="post" action="{{url('loginParent')}}">
          @if (count($errors)>0)
          <ul>
           @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
         </ul>
         @endif
         {{ csrf_field() }}
         <div class="form-group">
           <label class="sr-only" for="parentusername">Username</label>
           <input type="text" class="form-control input-sm" placeholder="Username" name="parentusername" required>
         </div>
         <div class="form-group">  
           <label class="sr-only" for="parentpassword">Password</label>
           <input type="password" class="form-control input-sm" placeholder="Password" name="parentpassword" required>
		 </div>
           <div class="checkbox">
             <label>
               <input type="checkbox"> <B>Remember me</B>
             </label>
           </div>
           <div class="form-footer">
            <a href="{{ url('forgetPassword') }}"><B>Forgot your password?</B></a>
          </div>
          <button type="submit" class="btn btn-info btn-xs"><B>Sign in</B></button>
          <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><B>Cancel</B></button>            
        </form>
    </div>
  </div>
</div>
</div>


<div id="Student" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"> &times;</button>
        <h4>Student Login</h4>
      </div>
      <div class="modal-body">
       <form role="form" class="form-inline" method="post" action="{{url('loginStudent')}}">
        @if (count($errors)>0)
        <ul>
         @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
       </ul>
       @endif
       {{ csrf_field() }}
       <div class="form-group">
         <label class="sr-only" for="studentusername">Username</label>
         <input type="text" class="form-control input-sm" placeholder="Username" name="studentusername" required>
       </div>
       <div class="form-group">  
         <label class="sr-only" for="studentpassword">Password</label>
         <input type="password" class="form-control input-sm" placeholder="Password" name="studentpassword" required>
       </div>
       <div class="checkbox">
         <label>
           <input type="checkbox"> <B>Remember me</B>
         </label>
       </div>
       <div class="form-footer">
        <a href="{{ url('forgetPassword') }}"><B>Forgot your password?</B></a>
      </div>
      <button type="submit" class="btn btn-info btn-xs"><B>Sign in</B></button>
      <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><B>Cancel</B></button>            
    </form>
  </div>
</div>
</div>
</div>


<div class="row navbar-row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar-container">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#tm-section-1"><B>Home</B></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#tm-section-3"><B>About</B></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#tm-section-4"><B>Contact</B></a>
      </li>
      
    </ul>
	
    <nav class="navbar navbar-full">
      <div class="collapse navbar-toggleable-md" id="tmNavbar">                            
       <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#Employee"><span class="glyphicon glyphicon-log-in"></span> Employee</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#Parent"><span class="glyphicon glyphicon-log-in"></span> Parent</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#Student"><span class="glyphicon glyphicon-log-in"></span> Student</a></li>
        </ul>     
      </div>
    </div>
  </nav>    
</div>
</div>

<section class="row tm-section">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="item active">
      <img src="pic/slider_1.jpg" style="height:85vh; width:100%;">
    </div>
    @foreach($newss as $key => $newsValue)
    <div class="item">
      <img src="data:image/jpg;base64,{{$newsValue['picture']}}" style="height:85vh; width:100%;">
      <div class="carousel-caption">
        <h1 style="text-align: justify;background:rgba(0,0,0,0.6);left:0;right:0;bottom:0;padding:10px;text-shadow:none;">{{$newsValue['title']}}</h1>
        <h3 style="text-align: justify;background:rgba(0,0,0,0.6);left:0;right:0;bottom:0;padding:10px;text-shadow:none;">{{$newsValue['content']}}</h3>
      </div>
    </div>
    @endforeach
  </div>
  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>

<!-- #about -->
<section id="tm-section-3" class="row tm-section">
  <div class="tm-white-curve-left col-xs-12 col-sm-6 col-md-6 col-lg-7 col-xl-6">
    <div class="tm-white-curve-left-rec">

    </div>
    <div class="tm-white-curve-left-circle">

    </div>
    <div class="tm-white-curve-text">
      <h2 class="tm-section-header gray-text">About our school</h2>
      <p class="thin-font" style="text-align: justify;"> We provide a unique educational experience for all children by devoting all of our efforts to our strong mission statements, philosophy and culture. Our goal is to provide our diverse student body with exceptional education, instilling in young people a love of learning, the ability to think independently and the confidence to pursue their dreams and goals. We offer an extraordinary academic and extracurricular program with high standards; we support each of our students as they work to reach different milestones.</p>   
    </div>

  </div>
  <div class="tm-flex-center col-xs-12 col-sm-6 col-md-6 col-lg-5 col-xl-6">
    <img src="pic/strip-02.jpg" alt="Image" class="img-fluid tm-img">
  </div>
</section> <!-- #about -->

<!-- #contact -->
<section id="tm-section-4" class="row tm-section">
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5 col-xl-6 tm-contact-left">
    <h2 class="tm-section-header thin-font col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">Send A Message</h2>
    <form action="index.html" method="post" class="contact-form">

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-6 tm-contact-form-left">
        <div class="form-group">
          <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name"  required/>
        </div>
        <div class="form-group">
          <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"  required/>
        </div>
        <div class="form-group">
          <input type="text" id="contact_subject" name="contact_subject" class="form-control" placeholder="Subject"  required/>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-6 tm-contact-form-right">
        <div class="form-group">
          <textarea id="contact_message" name="contact_message" class="form-control" rows="6" placeholder="Message" required></textarea>
        </div>

        <button type="submit" class="btn submit-btn"><B>Send It Now</B></button>
      </div>

    </form>   
  </div>

  <div class="tm-white-curve-right col-xs-12 col-sm-6 col-md-6 col-lg-7 col-xl-6">

    <div class="tm-white-curve-right-circle"></div>
    <div class="tm-white-curve-right-rec"></div>

    <div class="tm-white-curve-text">

      <h2 class="tm-section-header green-text">Contact Us</h2>
      

      <h3 class="tm-section-subheader green-text">Our Address</h3>
      <address>
        110-220 Praesent consectetur, Dictum massa 10550
      </address>

      <div class="contact-info-links-container">
        <span class="green-text contact-info">
         Tel: <a href="tel:0100200340" class="contact-info-link">010-020-0340</a></span>
         <span class="green-text contact-info">
           Email: <a href="mailto:info@school.com" class="contact-info-link">info@school.com</a></span>    
         </div>

       </div>                        

     </div>
   </section> <!-- #contact -->

   <!-- footer -->
   <footer class="row tm-footer">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

      <p class="text-xs-center tm-footer-text"><B>Copyright &copy; 2018 School Name</B></p>

    </div>

  </footer>                      

</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>	
<script src="js/jquery.singlePageNav.min.js"></script>

<script>     
  var bigNavbarHeight = 90;
  var smallNavbarHeight = 68;
  var navbarHeight = bigNavbarHeight;                 

  $(document).ready(function(){

    var topOffset = 180;

    $(window).scroll(function(){

      if($(this).scrollTop() > topOffset) {
        $(".navbar-container").addClass("sticky");
      }
      else {
        $(".navbar-container").removeClass("sticky");
      }

    });

            /* Single page nav
            -----------------------------------------*/

            if($(window).width() < 992) {
              navbarHeight = smallNavbarHeight;
            }

            $('#tmNavbar').singlePageNav({
             'currentClass' : "active",
             offset : navbarHeight
           });


            /* Collapse menu after click 
               http://stackoverflow.com/questions/14203279/bootstrap-close-responsive-menu-on-click
               ----------------------------------------------------------------------------------------*/

               $('#tmNavbar').on("click", "a", null, function () {
                $('#tmNavbar').collapse('hide');               
              });

            // Handle nav offset upon window resize
            $(window).resize(function(){
              if($(window).width() < 992) {
                navbarHeight = smallNavbarHeight;
              } else {
                navbarHeight = bigNavbarHeight;
              }

              $('#tmNavbar').singlePageNav({
                'currentClass' : "active",
                offset : navbarHeight
              });
            });
            

            /*  Scroll to top
                http://stackoverflow.com/questions/5580350/jquery-cross-browser-scroll-to-top-with-animation
                --------------------------------------------------------------------------------------------------*/
                $('#go-to-top').each(function(){
                  $(this).click(function(){ 
                    $('html,body').animate({ scrollTop: 0 }, 'slow');
                    return false; 
                  });
                });

              });

            </script>
          </body>
          </html>