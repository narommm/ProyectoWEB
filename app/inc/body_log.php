<body>
<!-- asignando nombre a clase para animacoones -->
<div class="topbar animated fadeInLeftBig"></div>

<!-- Header iniciado -->
<div class="navbar-wrapper">
      <div class="container">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
        <!-- creando contenedor -->
          <div class="container">
          <!-- declarando cabecera del contenedor con una clase header-->
            <div class="navbar-header">
              <!-- Iniciando Logo en index -->
              <a class="navbar-brand" href="#index.php"><img src="images/LOGO1.png" alt="logo"></a>
              <!-- creacion de boton  -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <!-- creando spans, como acomodadores oara los iconos -->
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>


            <!-- iniciando spans -->
            <div class="navbar-collapse  collapse">
            <!-- iniciando nav para menú -->
              <ul class="nav navbar-nav navbar-right">
              <!-- menu representado con inicio, sobre, calenadrio, reserva, salir -->
                 <li class="active"><a href="index.php">Home</a></li>
                 <li ><a href="#about">Nosotros</a></li>
                 <li ><a href="app/jqueryCalendar/calendar.php">Calendario</a></li>
                 <li ><a href="app/jqueryCalendar/AddPeticion.php">Reservar</a></li>
                 <li><a href="salir.php"><?php echo('Salir ('.$_SESSION['usuario'].')') ?></a></li>
              </ul>
            </div>
            <!-- cerrando nav -->

          </div>
        </div>

      </div>
    </div>
<!-- iniciando header -->




<div id="home">
<!-- iniciando carouser de imagenes y la animación -->
<div id="myCarousel" class="carousel slide banner-slider animated bounceInDown" data-ride="carousel">     
      <div class="carousel-inner">
        <!-- Añadiendo imagen 1 -->
        <div class="item active">
          <img src="images/BACK1.jpg" alt="banner">
        </div>

        <!--Añadiendo imagen 2 -->
        <div class="item">
          <img src="images/BACK2.jpg" alt="banner">
        </div>

        <!-- Añadiendo imagen 3 -->
        <div class="item">
          <img src="images/BACK3.jpg" alt="banner">
        </div>
       
      </div>
      <!-- Configurando links hacia carousel mediante botones laterales -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon-chevron-left"><i class="fa fa-angle-left"></i></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon-chevron-right"><i class="fa fa-angle-right"></i></span></a>
    </div>
<!-- Finalizando animación -->
</div>

<!-- iniciando el about con un contenedor -->
<div id="about"  class="container spacer about">
<!-- Añadiendo un texto como tema a nuestro contenedor -->
<h2 class="text-center wowload fadeInUp">Sistema de reserva de laboratorios.</h2>  
  <div class="row">
  <div class="col-sm-6 wowload fadeInLeft">
  <!-- Especificando aspectos de relevancia a nuestra información -->
    <h4><i class="fa fa-flag"></i> Introducción</h4>
    <!-- Montando un parrafo  -->
    <p>Bienvenido al sistema de reservas de la universidad José Simeón Cañas (UCA) en el cual podrá solicitar el uso de nuestras instalaciones. Contamos con # laboratorios a su disposición cuyos horarios hábiles son de lunes a  viernes desde las 7:00 am hasta las 7:00 pm. Además de días sábados de 7:00 am a 3:00 pm.</p>
    
  </div>
  <!-- Agregando un nuevo div a la par de nuetra intro, con información importante-->
  <div class="col-sm-6 wowload fadeInRight">
  <h4><i class="fa fa-fire"></i></i> Importante.</h4>
  <!-- Agregando parrafo de información relevante -->
  <p>La Universidad José Simeón Cañas se reserva los derechos de admisión de agentes externos a nuestro sistema, por lo que estos deberán contactar a nuestro administrador de servicios solicitándole credenciales de uso del sistema.</p>    
  </div>
  </div>
<!-- Abiendo nueva sección de, servicios, la cual contendra las reservas -->
  <div class="services">
    <h3 class="text-center wowload fadeInUp">Servicios</h3>
    <ul class="row text-center list-inline  wowload bounceInUp">
        <li>
        <!-- agregando link de reserva -->
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
<!-- finalizando divs -->
<br>
<br>
<br>
<!-- iniciando vid contenedor -->
<div id="calendar"  class=" clearfix grid"> 
    <figure class="effect-oscar  wowload fadeInUp">
    <!-- añadiendo imagenes alusivas a laboratorios, para promoción llamativa de interés -->
          <img src="images/pictures/icpc.jpg" alt="img01"/>
        <figcaption>
        <!-- nombrando a a la competencia ICPC como acontecimiento importante -->
            <h2>ICPC</h2>
            <p>International Competition<br>
            <!-- Añadiendo una sección de ver más para proporcionar información -->
            <a href="images/portfolio/2.jpg" title="1">View more</a></p>     
        </figcaption>
        <!-- finalizando la primera animación -->
    </figure>
    <!-- iniciando nueva animación de proxima imagen -->
     <figure class="effect-oscar  wowload fadeInUp">
     <!-- añadiendo la inserción de nuestra imagen -->
        <img src="images/portfolio/2.jpg" alt="img01"/>
        <figcaption>
        <!-- nombrando la secunda asección de nuestro contenedor -->
            <h2>Febrero</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <!-- Añadiendo una opción de ver más  -->
            <a href="images/portfolio/2.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    <!-- iniciando proxima sección -->
     <figure class="effect-oscar  wowload fadeInUp">
     <!-- añadiendo imagen -->
        <img src="images/portfolio/3.jpg" alt="img01"/>
        <figcaption>
        <!-- nombando a nuestra sección -->
            <h2>music</h2>
            <!-- insertando un verso -->
            <p>Lily likes to play with crayons and pencils<br>
            <!-- ver mas como una opción  -->
            <a href="images/portfolio/3.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
</div>
</div>
</div>
</div>
<br>
<!-- La biblioteca de la Galería de imágenes Bootstrap, debe ser un elemento secundario del body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- iniciando el contenedor -->
    <div class="slides"></div>
    <!-- controlando las caracteristicas del contenedor -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- modelo del dialogo, el cual contendra el contenedor -->   
</div>
<?php
  include 'app/inc/footer.php';
?>
<!-- recursos de jquery -->
<script src="assets/jquery.js"></script>

<!-- wow script -->
<script src="assets/wow/wow.min.js"></script>
 

<!-- haciendo uso de la biblioteca boostrap para el desarrollo de animaciones -->
<script src="assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>

<!-- animaciones de jquery mobile -->
<script src="assets/mobile/touchSwipe.min.js"></script>
<script src="assets/respond/respond.js"></script>

<!-- requiriendo recursos de gallery -->
<script src="assets/gallery/jquery.blueimp-gallery.min.js"></script>

<!-- recursos de script.js -->
<script src="assets/script.js"></script>

</body>