
<body>
<div class="topbar animated fadeInLeftBig"></div>

<!-- Header Starts -->
<div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
          <div class="container">
            <div class="navbar-header">
              <!-- Logo Starts -->
              <a class="navbar-brand" href="#home"><img src="images/LOGO1.png" alt="logo"></a>
              <!-- #Logo Ends -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                 <li class="active"><a href="#home">Home</a></li>
                 <li ><a href="#about">About</a></li>
                 <li ><a href="#calendar">Calendar</a></li>
                 <li ><a href="#contact">Contact</a></li>
                 <li><a href="salir.php">Salir</a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>

      </div>
    </div>
<!-- #Header Starts -->




<div id="home">
<!-- Slider Starts -->
<div id="myCarousel" class="carousel slide banner-slider animated bounceInDown" data-ride="carousel">     
      <div class="carousel-inner">
        <!-- Item 1 -->
        <div class="item active">
          <img src="images/BACK1.jpg" alt="banner">
        </div>
        <!-- #Item 1 -->

        <!-- Item 1 -->
        <div class="item">
          <img src="images/BACK2.jpg" alt="banner">
        </div>
        <!-- #Item 1 -->

        <!-- Item 1 -->
        <div class="item">
          <img src="images/BACK3.jpg" alt="banner">
        </div>
        <!-- #Item 1 -->

       
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon-chevron-left"><i class="fa fa-angle-left"></i></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon-chevron-right"><i class="fa fa-angle-right"></i></span></a>
    </div>
<!-- #Slider Ends -->
</div>

<!-- Cirlce Starts -->
<div id="about"  class="container spacer about">
<h2 class="text-center wowload fadeInUp">Sistema de reserva de laboratorios.</h2>  
  <div class="row">
  <div class="col-sm-6 wowload fadeInLeft">
    <h4><i class="fa fa-flag"></i> Introducción</h4>
    <p>Bienvenido al sistema de reservas de la universidad José Simeón Cañas (UCA) en el cual podrá solicitar el uso de nuestras instalaciones. Contamos con # laboratorios a su disposición cuyos horarios hábiles son de lunes a  viernes desde las 7:00 am hasta las 7:00 pm. Además de días sábados de 7:00 am a 3:00 pm.</p>
    

  </div>
  <div class="col-sm-6 wowload fadeInRight">
  <h4><i class="fa fa-fire"></i></i> Importante.</h4>
  <p>La Universidad José Simeón Cañas se reserva los derechos de admisión de agentes externos a nuestro sistema, por lo que estos deberán contactar a nuestro administrador de servicios solicitándole credenciales de uso del sistema.</p>    
  </div>
  </div>

  <div class="services">
    <h3 class="text-center wowload fadeInUp">Servicios</h3>
    <ul class="row text-center list-inline  wowload bounceInUp">
        <li>
              <span><i class="fa fa-desktop"></i><b><a href="app/jqueryCalendar/index.php">Reservas</a></b></span>
          </li>
          <li>
              <span><i class="fa fa-cube"></i><b></b>dfjfhalda</span>
          </li>
          <li>
              <span><i class="fa fa-graduation-cap"></i><b>Trainings</b></span>
          </li>

      </ul>
    </div>
</div>
<!-- #Cirlce Ends -->
<br>
<br>
<br>
<!-- works -->
<div id="calendar"  class=" clearfix grid"> 
    <figure class="effect-oscar  wowload fadeInUp">
          <img src="images/pictures/icpc.jpg" alt="img01"/>
        <figcaption>
            <h2>ICPC</h2>
            <p>International Competition<br>
            <a href="images/portfolio/2.jpg" title="1">View more</a></p>     
        </figcaption>
    </figure>
     <figure class="effect-oscar  wowload fadeInUp">
        <img src="images/portfolio/2.jpg" alt="img01"/>
        <figcaption>
            <h2>Febrero</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="images/portfolio/2.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
     <figure class="effect-oscar  wowload fadeInUp">
        <img src="images/portfolio/3.jpg" alt="img01"/>
        <figcaption>
            <h2>music</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="images/portfolio/3.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
</div>
</div>
</div>
</div>


<div id="contact" class="spacer">
<!--Contact Starts-->
<div class="container contactform center">
<h2 class="text-center  wowload fadeInUp">Contáctanos.</h2>
  <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12">      
        <input type="text" placeholder="Name">
        <input type="text" placeholder="Company">
        <input type="email" placeholder="email">
        <textarea rows="5" placeholder="Message"></textarea>
        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send</button>
      </div>
  </div>
</div>
</div>
<!--Contact Ends-->


<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->    
</div>
<?php
  include 'app/inc/footer.php';
?>
<!-- jquery -->
<script src="assets/jquery.js"></script>

<!-- wow script -->
<script src="assets/wow/wow.min.js"></script>
 

<!-- boostrap -->
<script src="assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>

<!-- jquery mobile -->
<script src="assets/mobile/touchSwipe.min.js"></script>
<script src="assets/respond/respond.js"></script>

<!-- gallery -->
<script src="assets/gallery/jquery.blueimp-gallery.min.js"></script>

<!-- custom script -->
<script src="assets/script.js"></script>

</body>