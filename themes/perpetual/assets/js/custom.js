/* Exo 3 */
$(document).ready(function() {

    if($('.owl-carousel').length) 

        $('.owl-carousel').owlCarousel({
            margin: 10,
            loop: false,
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 3
              },
              1000: {
                items: 5
              }
            }
          })
})