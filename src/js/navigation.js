//mobile menu option
$('.hamburg').on('click', function () {
  $('.side-nav').toggleClass('active');
  $('.hamburg').toggleClass('close'); 
  $('body').toggleClass('overflow');
  $('.overlay-black').toggleClass('active');
});

$('.nav-list a[href="#performance!"]').on('click', function(){
  if($('.side-nav').hasClass('active')){
    $('.side-nav').removeClass('active');
    $('.hamburg').removeClass('close'); 
  }
});