
  $(function () {

    // MENU
   

    // AOS ANIMATION
    AOS.init({
      disable: 'mobile',
      duration: 800,
      anchorPlacement: 'center-bottom'
    });

    $(document).ready(function() {

      $('.dropdown-menu a.dropdown-item').click(function(event) {
    
        event.preventDefault();
  
  
        var href = $(this).attr('href');
  
        
        window.location.href = href;
      });
    });


    // SMOOTHSCROLL NAVBAR
    $(function() {
      $('.link-smooth, .hero-text a' ).on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 49
        }, 1000);
        event.preventDefault();
      });
    });    
  });


    

