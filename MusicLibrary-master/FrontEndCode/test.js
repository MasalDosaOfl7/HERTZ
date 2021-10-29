<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

$(document).ready(function() {
    var playing = false;

    $('.play-pause').click(function() {
        $('.play-pause i').removeClass('fa-pause').addClass('fa-play');
        if ($(this).siblings('.audio').get(0).paused) {
              //pause all audio
              $('.audio').each(function(){
                  this.pause();
              });
              //start the sibbling audio of the current clicked button, the get function gets the dom object instead of the jQuery object
              $(this).siblings('.audio').get(0).play();
              $(this).find('.fa').removeClass('fa-play').addClass('fa-pause');

          } else {
              $(this).siblings('.audio').get(0).pause();
              $(this).find('.fa').removeClass('fa-pause').addClass('fa-play');
          }
      });
});