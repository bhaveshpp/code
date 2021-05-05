/***************************************************
	hero-slider 
****************************************************/

$(document).ready(function(){
  $('.hero-slider').slick({
    dots: true,
    infinite: true,
    speed: 1000,
    slidesToShow: 1,
    arrows: false,
  });
});



/***************************************************
	portfolio-slider 
****************************************************/

$(document).ready(function(){
  $('.port-slider').slick({
    dots: false,
    infinite: true,
    speed: 1000,
    fade: true,
    slidesToShow: 1,
    arrows: true,
    cssEase: 'linear'
  });
});



/***************************************************
	values-slider 
****************************************************/

$(document).ready(function(){
  $('.val-slider').slick({
    dots: false,
    infinite: true,
    speed: 1000,
    slidesToShow: 2,
    arrows: false,
    responsive: [
      {
        breakpoint: 501,
        settings: {
          slidesToShow: 1,
        }
      },
    ]
  });
});

$(document).ready(function(){
  $('.val-slider2').slick({
    dots: false,
    infinite: true,
    speed: 1000,
    slidesToShow: 3,
    arrows: false,
    responsive: [
      {
        breakpoint: 501,
        settings: {
          slidesToShow: 1,
        }
      },
    ]
  });
});
$(document).ready(function(){
  $('.val-slider3').slick({
    dots: false,
    infinite: true,
    speed: 1000,
    slidesToShow: 2,
    arrows: false,
    responsive: [
      {
        breakpoint: 501,
        settings: {
          slidesToShow: 1,
        }
      },
    ]
  });
});

/***************************************************
	custom popup (for all)
****************************************************/


$("body").on('click', ".popup-opener", function(e){
  e.preventDefault();
  var $parents = $(this).attr('data-popup-id');
  var $customPop = $(this).attr('data-overlay');
  $("div[data-popup='" + $parents + "']").addClass("active");
  if($customPop !== "false"){$('.overlay').addClass("active");}
  $("div[data-popup='" + $parents + "']").siblings(".cs-popup").removeClass("active");
  $(this).addClass("active");
  $("body").addClass("popup-active");
});

$("body").on('click', ".close-icon", function(e){
  e.preventDefault();
  var $parents = $('.active').attr('data-popup');
  $(".cs-popup").removeClass("active");
  $('.overlay').removeClass("active");
  $('.popup-opener').removeClass("active");
  $('body').removeClass("popup-active");
});

$("body").on('click', ".overlay", function(e){
  e.preventDefault();
  var $parents = $('.active').attr('data-popup');
  $('.cs-popup').removeClass('active');
  $('.overlay').removeClass("active");
  $('.popup-opener').removeClass("active");
  $('body').removeClass("popup-active");
});

$(document).keyup(function(e) {
  if (e.keyCode == 27) {
    $(".cs-popup").removeClass("active");
    $('.overlay').removeClass("active");
    $('.popup-opener').removeClass("active");
    $('body').removeClass("popup-active");
  }
});


$(".menu-toggler").click(function(e){
    $(this).toggleClass('active');
    $(".mega-menu").toggleClass('active');
    $("body").toggleClass('active');
});


$(".pos-bx .theme-btn3").click(function(){
  $('.crr-popup').addClass("popup-active");
  $('body').addClass("popup-open");
  $('.overlay').addClass("active");
});

$(".crr-close-btn").click(function(){
  $('.crr-popup').removeClass("popup-active");
   $('body').removeClass("popup-open");
   $('.overlay').removeClass("active");
});

/**
 * Save contact form data
 */
function validateContactForm() {
  let fname = jQuery('#fname');
  let lname = jQuery('#lname');
  let email = jQuery('#email');
  let sub = jQuery('#sub');
  let ser = jQuery('#ser');
  let msg = jQuery('#msg');

  if (fname[0].checkValidity() == "") {
    fname.focus();
    return false;
  }
  if (lname[0].checkValidity() == "") {
    lname.focus();
    return false;
  }
  if (email[0].checkValidity() == "") {
    email.focus();
    return false;
  }
  if (sub[0].checkValidity() == "") {
    sub.focus();
    return false;
  }
  if (ser[0].checkValidity() == "") {
    ser.focus();
    return false;
  }
  if (msg[0].checkValidity() == "") {
    msg.focus();
    return false;
  }
  
  return true;
}
$(".save-contact-btn").click(function(){
  if (validateContactForm()) {
    let fname = jQuery('#fname');
    let lname = jQuery('#lname');
    let email = jQuery('#email');
    let sub = jQuery('#sub');
    let ser = jQuery('#ser');
    let msg = jQuery('#msg');
    var data = {
      SUBMIT: {
        CONTACT: {
          contact_name: fname.val()+" "+lname.val(),
          contact_email: email.val(),
          contact_subject: sub.val(),
          contact_service: ser.val(),
          contact_message: msg.val(),
        }
      }
    };
    $.post( BASE_URL + "request.php", data).done(function (data) {
      console.log(data);
      data = JSON.parse(data);
      var scrollPos =  $(".git-right").offset().top;
      $(window).scrollTop(scrollPos);
      if (data.success) { 
        jQuery('.contact-form.ajax-success').show().fadeOut(5000);
      }else{
        jQuery('.contact-form.ajax-error').show().fadeOut(5000);
      }
    });
  } else {
    return false;   
  }
});

/**
 * Save newsletter form data
 */
function validateNewsletter() {
  let nwemail = document.getElementById('newsletter_email');
  if (nwemail.checkValidity()) {
    return true;
  }else{
    nwemail.focus();
    return false;
  }
}
$("#newsletter-form").submit(function(e){
  e.preventDefault();
  if (validateNewsletter()) {
    var data = {
      SUBMIT: {
        NEWSLETTER: {
          email: jQuery('#newsletter_email').val(),
        }
      }
    };
  
    $.post( BASE_URL + "request.php", data).done(function (data) {
      console.log(data);
      data = JSON.parse(data);
      var scrollPos =  $("#newsletter-form").offset().top;
      $(window).scrollTop(scrollPos);
      if (data.success) { 
        jQuery('.newsletter.ajax-success').html(data.message).show().fadeOut(5000);
      }else{
        jQuery('.newsletter.ajax-error').html(data.message).show().fadeOut(5000);
      }
    });
  }
});


/**
 * Save careear form data
 */

function validateCareer() {
  let name = jQuery('#careear_name');
  let email = jQuery('#careear_email');
  let role = jQuery('#careear_role');
  let phone = jQuery('#careear_phone');
  let location = jQuery('#careear_location');
  let exp = jQuery('#careear_exp');
  let resume = jQuery('#resume');
  let msg = jQuery('#careear_msg');
  
  if (name[0].checkValidity() == "") {
    name.focus();
    return false;
  }

  if (email[0].checkValidity() == "") {
    email.focus();
    return false;
  }

  if (role[0].checkValidity() == "") {
    role.focus();
    return false;
  }

  if (phone[0].checkValidity() == "") {
    phone.focus();
    return false;
  }

  if (location[0].checkValidity() == "") {
    location.focus();
    return false;
  }

  if (exp[0].checkValidity() == "") {
    exp.focus();
    return false;
  }

  if (resume[0].checkValidity() == "") {
    resume.focus();
    return false;
  }

  if (msg[0].checkValidity() == "") {
    msg.focus();
    return false;
  }
  
  return true;
}

 $("#careear_form").submit(function(e){
  e.preventDefault();
  if (validateCareer()) {

    let name = jQuery('#careear_name');
    let email = jQuery('#careear_email');
    let role = jQuery('#careear_role');
    let phone = jQuery('#careear_phone');
    let location = jQuery('#careear_location');
    let exp = jQuery('#careear_exp');
    let msg = jQuery('#careear_msg');

    var fileInputElement = document.getElementById('resume');
    var formData = new FormData();

    formData.append("SUBMIT[CAREER][career_service]", role.val());
    formData.append("SUBMIT[CAREER][career_name]", name.val());
    formData.append("SUBMIT[CAREER][career_email]", email.val());
    formData.append("SUBMIT[CAREER][career_phone]", phone.val());
    formData.append("SUBMIT[CAREER][career_location]", location.val());
    formData.append("SUBMIT[CAREER][career_experience]", exp.val());
    formData.append("SUBMIT[CAREER][career_message]", msg.val());
    formData.append("career_resume", fileInputElement.files[0]);
    
    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
      if (request.readyState == 4 && request.status == 200){
        let data = request.responseText;
        console.log(data);
        data = JSON.parse(data);
        if (data.success) { 
          jQuery('.careear.ajax-success').html(data.message).show().fadeOut(5000);
        }else{
          jQuery('.careear.ajax-error').html(data.message).show().fadeOut(5000);
        }
      }
    }
    request.open("POST", BASE_URL + "request.php");
    request.send(formData);

  }else{
    return false;
  }

});