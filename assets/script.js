 jQuery(document).ready(function($) {
 /* escuchando eventos */
    $(".scroll a, .navbar-brand, .gototop").click(function(event){   
    event.preventDefault();
    /* estableciendo las coordenadas de desplazamiento para el body */
    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 600,'swing');
    $(".scroll li").removeClass('active');
    $(this).parents('li').toggleClass('active');
    });
    });






var wow = new WOW(
  {
    boxClass:     'wowload',      //animaciones del css (default is wow)
    animateClass: 'animated', // animation css class (daimado por defecto)
    offset:       0,          // Distancia hasta el elemento cuando se activa el elemento (asignado en 0)
    mobile:       true,       // activar las animaciones del dispositivo (inincializado en true)
    live:         true        // activar asincrónicamente la carga del contenido (inincializado en true)
  }
);
wow.init();



/* reando efectos visuales con carousel en imagenes, y estableciendo botones de anterior y sguiente en posicion vertical */
$('.carousel').swipe( {
     swipeLeft: function() {
         $(this).carousel('next');
     },
     swipeRight: function() {
         $(this).carousel('prev');
     },
     allowPageScroll: 'vertical'
 });



