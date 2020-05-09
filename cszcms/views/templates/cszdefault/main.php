<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>AU India</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Assumption University" />
<!-- css links -->
<?php echo link_tag('templates/cszdefault/css/bootstrap.min.css') ?>
<?php echo link_tag('templates/cszdefault/css/slider.css') ?>
<?php echo link_tag('templates/cszdefault/css/facultystyle.css') ?>
<?php echo link_tag('templates/cszdefault/css/jquery.fancybox.min.css') ?>
<?php echo link_tag('templates/cszdefault/css/font-awesome.min.css') ?>
<?php echo link_tag('templates/cszdefault/css/style.css') ?>

<!-- /css links -->
 <link href="<?php echo base_url() ?>templates/cszdefault/images/favicon.ico" rel="shortcut icon" type="image" />
 <link href='//fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'>
 <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
 <link href='//fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>
 <script src="<?php echo base_url() ?>templates/cszdefault/js/SmoothScroll.min.js"></script>
 <script src="<?php echo base_url() ?>templates/cszdefault/js/modernizr.custom.js"></script>
 <script src="<?php echo base_url() ?>templates/cszdefault/js/jquery.min.js"></script>

</head>
<body id="home" data-spy="scroll" data-target=".navbar" data-offset="60">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137780490-1"></script>
  <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'UA-137780490-1');
  </script>
<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>templates/cszdefault/images/abac_logo.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" style="visibility:hidden">
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="#home">HOME</a></li>
				<li><a class="navbar-nav-li-a" href="#about">ABOUT</a></li>
				<li><a class="navbar-nav-li-a" href="#programs">PROGRAMS</a></li>
				<li><a class="navbar-nav-li-a" href="#international-students">INTERNATIONAL STUDENTS</a></li>
				<li><a class="navbar-nav-li-a" href="#studentscenter">STUDENTS CENTER</a></li>
				<!-- <li><a href="#events">EVENTS</a></li> -->
				<li><a class="navbar-nav-li-a" href="#contact">CONTACT</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<!-- /Fixed navbar -->
<?php echo $content; ?>

<!-- Footer Section -->
<div class="footer">
	<div class="container">
		<div id="mobile-device">&nbsp;</div>
    <p style="text-align: center;"><a href="https://www.facebook.com/ABACIND/" target="_blank"><img src="<?php echo base_url() ?>templates/cszdefault/imgs/facebook_icon.png" alt="facebook" width="35" height="35" border="0"></a>&nbsp;&nbsp;<a href="https://twitter.com/ABACIND/" target="_blank"><img src="<?php echo base_url() ?>templates/cszdefault/imgs/twitter_icon.png" alt=""></a></p>
    <p> &copy; <?php echo date('Y');?> Assumption University. All Rights Reserved | Designed by <a href="http://rigpa.in" target="_blank">Rigpa Tech</a><a class="youtube-a" data-fancybox href="https://www.youtube.com/watch?v=gO7ARD0SEzA">&nbsp;</a></p>
	</div>
</div>
<!-- //Footer Section -->
<!-- js files -->
<script src="<?php echo base_url() ?>templates/cszdefault/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>templates/cszdefault/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url() ?>templates/cszdefault/js/jquery.localScroll.min.js"></script>
<script src="<?php echo base_url() ?>templates/cszdefault/js/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
<script src="<?php echo base_url() ?>templates/cszdefault/js/common.js"></script>
<script src="<?php echo base_url() ?>templates/cszdefault/js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>templates/cszdefault/js/numscroller-1.0.js"></script>
<script src="<?php echo base_url() ?>templates/cszdefault/js/responsiveslides.min.js"></script>
<script>
$(document).ready(function() {
  $(".navbar a, footer a[href='#home'],.scroll_down_a").on('click', function(event) {
    var hash = this.hash;
    console.log($(hash).offset().top);
    $('html, body').animate({
      scrollTop: $(hash).offset().top,
    }, 900, function() {
      window.location.hash = hash;
    });
  });
  var is_mobile = false;
  if ($('#mobile-device').css('display') == 'none') {
    is_mobile = true;
    $(".navbar-nav").css('visibility', 'visible');
  }
  if (is_mobile == false) {
    if (document.documentElement.scrollTop > 100) {
      $(".navbar-default").css('background-color', '#B31E20');
      $(".navbar-nav").css('visibility', 'visible');
    } else {
      $(".navbar-nav").css('visibility', 'hidden');
    }
    var scroll_pos = 0;
    $(document).scroll(function() {
      scroll_pos = $(this).scrollTop();
      if (scroll_pos > 100) {
        $(".navbar-default").css('background-color', '#B31E20');
        $(".navbar-nav").css('visibility', 'visible');
      } else {
        $(".navbar-nav").css('visibility', 'hidden');
        $(".navbar-default").css('background-color', 'transparent');
      }
    });
  } else {
    if (document.documentElement.scrollTop > 100) {
      $(".navbar-brand").css('visibility', 'hidden');
    } else {
      $(".navbar-brand").css('visibility', 'visible');
    }
    $(".navbar-default").css('background-color', 'transparent');
    var scroll_pos = 0;
    $(document).scroll(function() {
      scroll_pos = $(this).scrollTop();
      if (scroll_pos > 100) {
        $(".navbar-brand").css('visibility', 'hidden');
      } else {
        $(".navbar-brand").css('visibility', 'visible');
      }
    });
    $(".navbar-nav").css('visibility', 'visible');
    $(document, 'body', '.navbar-nav-li-a').click(function(event) {
      console.log('nav-click');
      var clickover = $(event.target);
      var _opened = $(".navbar-collapse").hasClass("in");
      console.log(_opened);
      console.log(clickover.hasClass("navbar-toggle"));
      if (_opened === true && !clickover.hasClass("navbar-toggle")) {
        console.log('nav-click-toggle');
        $("button.navbar-toggle").click();
        $(".navbar-default").css('background-color', 'transparent');
        $(".navbar-brand").css('visibility', 'hidden');
      }
    });
    $('.navbar-toggle').click(function(event) {
      var clickover = $(event.target);
      var _opened = $(".navbar-collapse").hasClass("in");
      if (_opened === true) {
        console.log('navbar-toggle-click-apply-trans');
        $(".navbar-default").css('background-color', 'transparent');
        $(".navbar-brand").css('visibility', 'hidden');
      } else {
        console.log('navbar-toggle-click-apply-color');
        $(".navbar-default").css('background-color', '#B31E20');
        $(".navbar-brand").css('visibility', 'visible');
      }
    });
  }
  $('.carousel').carousel({
    interval: 3000
  });
  if ($('.courseitem').length > 1) {
    $(".carousel-control").css('visibility', 'visible');
  } else {
    $(".carousel-control").css('visibility', 'hidden');
  }

  /*$('.youtube-a').fancybox({
    caption: function(instance, item) {
      return '';
    }
  });*/

  $("#slider3").responsiveSlides({
    auto: true,
    pager: true,
    nav: false,
    speed: 500,
    namespace: "callbacks",
    before: function() {
      $('.events').append();
    },
    after: function() {
      $('.events').append();
    }
  });
  var accordionsMenu = $('.cd-accordion-menu');

  if (accordionsMenu.length > 0) {
    accordionsMenu.each(function() {
      var accordion = $(this);
      accordion.on('change', 'input[type="checkbox"]', function() {
        var checkbox = $(this);
        console.log(checkbox.prop('checked'));
        (checkbox.prop('checked')) ? checkbox.siblings('ul').attr('style', 'display:none;').slideDown(300): checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300);
      });
    });
  }
});
</script>
<script src="//code.tidio.co/jffwceoebxvzokwhxxnwheplgbfoyvey.js"></script>
</body>
</html>
