/* SMOOTH SCROLLING */
$(document).ready(function(){
    // Add smooth scrolling to all links in navbar + welcome container links
    $(".go-to-top a, .jobs a, a.smooth-scroll").on('click', function(event) {

        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
            //substitute 70px from scroll top
            //because 70px height fixed navigation bar
            scrollTop: $(hash).offset().top - 70
        }, 900, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash - 70;
        });
    });
});


/* GO TO TOP ANIMATION */
$(document).ready(function(){
  $(window).scroll(function() {
    if ($(document).scrollTop() > 400) {
      $(".go-to-top").addClass("showArrow");
    } else {
      $(".go-to-top").removeClass("showArrow");
    }
  });
});

/* parallax scrolling */
$(document).ready(function(){

  var parallax = document.querySelectorAll(".custom-parallax"),
      speed = 0.2;

  window.onscroll = function(){
    [].slice.call(parallax).forEach(function(el,i){

      var windowYOffset = window.pageYOffset,
          elBackgrounPos = "50% " + (windowYOffset * speed) + "px";

      el.style.backgroundPosition = elBackgrounPos;

    });
  };

})();