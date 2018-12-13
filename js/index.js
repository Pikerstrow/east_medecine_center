;(function($) {
  "use strict";

  function preloader(){
    if ( $('.preloader').length ){
      $(window).on('load', function() {
        $('.preloader').delay(100).fadeOut('100');  // 5000 slow
          $('body').delay(100).css({'overflow':'visible'}); // 5000
      });
    }
  };

  new WOW().init();
  preloader ();

})(jQuery);

$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {
          $('.btn-top').fadeIn(50);
      } else {
          $('.btn-top').fadeOut(50);
      }
    if ($(document).scrollTop() > 100) {
        $('.navbar').addClass('affix');
      } else {
        $('.navbar').removeClass('affix');
      }
  });
  $('.btn-top').click(function() {
      $('body,html').animate({
          scrollTop : 0
      }, 2000);
  });

$('.dropdown-item ,.nav-link, .navbar-brand, .logo').click(function() {
  var sectionTo = $(this).attr('href');
    $('html, body').animate({
      scrollTop: $(sectionTo).offset().top
    }, 2000);
});

var forEach = function(t, o, r) {
  if ("[object Object]" === Object.prototype.toString.call(t))
    for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t);
  else
    for (var e = 0, l = t.length; l > e; e++) o.call(r, t[e], e, t)
};

var hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
  forEach(hamburgers, function(hamburger) {
    hamburger.addEventListener("click", function() {
      this.classList.toggle("is-active");
    }, false);
  });
}


/*CHECKS PASSWORDS MATCH*/
$(document).ready(function(){
    $("input[name='password_confirm']").on('keyup', function(){
        var password = $("input[name='password']").val();
        var passwordConfirm = $("input[name='password_confirm']").val();

        if(passwordConfirm.length > 1){
            if(password != passwordConfirm){
                $('.pass-conf-help-block').html("<span style='color:rgba(173,0,19,0.99);'><i class='far fa-frown'></i> Введені паролі не співпадають!</span>");
            } else {
                $('.pass-conf-help-block').html("<span style='color:rgba(10,146,5,0.99);'><i class=\"far fa-smile\"></i> Паролі співпадають</span>");
            }
        }

    });
});


/*SET VALIDATION CLASSES ON BACK-END VALIDATION*/
$(document).ready(function(){
    var validFormGroup = $('span.valid').closest('div.form-group');
    var invalidFormGroup = $('span.invalid').closest('div.form-group');
    var validInput = $(validFormGroup).find('input');
    var invalidInput = $(invalidFormGroup).find('input');

    $(validInput).each(function(){
        $(this).addClass('is-valid');
    });
    $(invalidInput).each(function(){
        $(this).addClass('is-invalid');
    });
    $(invalidInput).on('focus',function(){
        $(this).removeClass('is-invalid');
        $(this).parent().find('.invalid-feedback').remove();
    });

});

/*WRITE TO US*/
$(document).ready(function(){

    $('#send_message').click(function(e) {
        e.preventDefault();
        var formData = new FormData($('#write_us_form')[0]);

        if (formData.get('name') == false) {
            $('div.name-help').html("<span style='color:red'>Поле не може бути порожнім!</span>");
        } else if (formData.get('email') == false) {
            $('div.email-help').html("<span style='color:red'>Поле не може бути порожнім!</span>");
        } else if (formData.get('phone') == false) {
            $('div.phone-help').html("<span style='color:red'>Поле не може бути порожнім!</span>");
        } else if (formData.get('text') == false) {
            $('div.message-help').html("<span style='color:red'>Поле не може бути порожнім!</span>");
        } else {
            $.ajax({
                url: 'admin_panel/includes_admin/ajax_write_to_us.php',
                type: 'POST',
                data: formData,
                beforeSend: function(){
                    /*Removing classes from the previous validation (it it took place)*/
                    $('#write_us_form').find('input').each(function(){
                        $(this).removeClass('is-valid is-invalid');
                    });
                    $('#write_us_form').find('textarea').removeClass("is-valid-textarea is-invalid-textarea");
                    /*--end of 'removing' section*/

                    /*Disabling send button and displaying preloader*/
                    $('#send_message').prop("disabled", true);
                    $('#write_us_form').addClass('cover');
                    $('#write-us-form-div').append("<img class='gif-form-preload' src='img/Preloaders/wait_load_82.gif'>");
                },
                success: function (data) {
                    /*Checking what type of data we received (errors comes as JSON string, successful massage as a html code)*/
                    if(isJSON(data)){
                        setTimeout(function(){
                            $('#send_message').prop("disabled", false);
                            $('#write_us_form').removeClass('cover');
                            $('img.gif-form-preload').remove();

                            var response = JSON.parse(data);

                            if(response.hasOwnProperty('errors')){
                                var form = $('#write_us_form');
                                var inputName = $(form).find("input[name='name']");
                                var inputEmail = $(form).find("input[name='email']");
                                var inputPhone = $(form).find("input[name='phone']");
                                var inputText = $(form).find("textarea");

                                if(response.errors.hasOwnProperty('name')){
                                    $(inputName).addClass('is-invalid');
                                    $(inputName).parent().find('div.invalid-feedback').text(response.errors.name);
                                } else {
                                    $(inputName).addClass('is-valid');
                                }
                                if(response.errors.hasOwnProperty('email')){
                                    $(inputEmail).addClass('is-invalid');
                                    $(inputEmail).parent().find('div.invalid-feedback').text(response.errors.email);
                                } else {
                                    $(inputEmail).addClass('is-valid');
                                }
                                if(response.errors.hasOwnProperty('phone')){
                                    $(inputPhone).addClass('is-invalid');
                                    $(inputPhone).parent().find('div.invalid-feedback').text(response.errors.phone);
                                } else {
                                    $(inputPhone).addClass('is-valid');
                                }
                                if(response.errors.hasOwnProperty('text')){
                                    $(inputText).addClass('is-invalid-textarea');
                                    $(inputText).parent().find('div.message-help').html("<span style='color:#b5102a;'>" + response.errors.text + "</span>").addClass('is-invalid-textarea-helper');
                                } else {
                                    $(inputText).addClass('is-valid-textarea');
                                }
                            } else if(response.hasOwnProperty('create_error')){
                                $('#create-error-message-problem').addClass('alert alert-danger').append("<a href='#' class='close' data-dismiss='alert'>&times;</a><span>" + response.create_error + "</span>");
                            }
                        },1500);
                    } else {
                        setTimeout(function(){
                            $('#write-us-form-div').empty().addClass('text-center').html(data);
                            $('.gif-form-preload').remove();
                            $('#write_us_form').removeClass('cover');
                        },1500);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

            $('div.phone-help').empty();
            $('div.email-help').empty();
            $('div.name-help').empty();
            $('div.message-help').empty();
        }

    });

});

/*REVIEW US*/
$(document).ready(function(){
    $('#review_send').click(function(e){
        e.preventDefault();
        var formData = new FormData($('#review_us_form')[0]);

        if (formData.get('name') == false) {
            $('div.name-response-help').html("<span style='color:red'>Поле не може бути порожнім!</span>");
        } else if (formData.get('email') == false) {
            $('div.email-response-help').html("<span style='color:red'>Поле не може бути порожнім!</span>");
        } else if (formData.get('text') == false) {
            $('div.message-response-help').html("<span style='color:red'>Поле не може бути порожнім!</span>");
        } else {
            $.ajax({
                url: 'admin_panel/includes_admin/ajax_review_us.php',
                type: 'POST',
                data: formData,
                beforeSend: function(){
                    /*Removing classes from the previous validation (it it took place)*/
                    $('#review_us_form').find('input').each(function(){
                        $(this).removeClass('is-valid is-invalid');
                    });
                    $('#review_us_form').find('textarea').removeClass("is-valid-textarea is-invalid-textarea");
                    /*--end of 'removing' section*/

                    /*Disabling send button and displaying preloader*/
                    $('#review_send').prop("disabled", true);
                    $('#review-modal-content').append("<div class='cover-div text-center'></div>");
                    $('div.cover-div').append("<img class='gif-form-preload' src='img/Preloaders/wait_load_82.gif'>");
                },
                success: function (data) {
                    /*Checking what type of data we received (errors comes as JSON string, successful massage as a html code)*/
                    if(isJSON(data)){
                        setTimeout(function(){
                            $('#review_send').prop("disabled", false);
                            $('div.cover-div').remove();

                            var response = JSON.parse(data);

                            if(response.hasOwnProperty('errors')){
                                var form = $('#review_us_form');
                                var inputName = $(form).find("input[name='name']");
                                var inputEmail = $(form).find("input[name='email']");
                                var inputText = $(form).find("textarea");
                                var inputGender = $(form).find("input[name='gender']");

                                if(response.errors.hasOwnProperty('name')){
                                    $(inputName).addClass('is-invalid');
                                    $(inputName).parent().find('div.invalid-feedback').text(response.errors.name);
                                } else {
                                    $(inputName).addClass('is-valid');
                                }
                                if(response.errors.hasOwnProperty('email')){
                                    $(inputEmail).addClass('is-invalid');
                                    $(inputEmail).parent().find('div.invalid-feedback').text(response.errors.email);
                                } else {
                                    $(inputEmail).addClass('is-valid');
                                }
                                if(response.errors.hasOwnProperty('gender')){
                                    $(inputGender).addClass('is-invalid');
                                    $(inputGender).parent().find('div.invalid-feedback').text(response.errors.phone);
                                } else {
                                    $(inputGender).addClass('is-valid');
                                }
                                if(response.errors.hasOwnProperty('text')){
                                    $(inputText).addClass('is-invalid-textarea');
                                    $(inputText).parent().find('div.message-response-help').html("<span style='color:#b5102a;'>" + response.errors.text + "</span>").addClass('is-invalid-textarea-helper');
                                } else {
                                    $(inputText).addClass('is-valid-textarea');
                                }
                            } else if(response.hasOwnProperty('create_error')){
                                $('#create-error-problem').addClass('alert alert-danger').append("<a href='#' class='close' data-dismiss='alert'>&times;</a><span>" + response.create_error + "</span>");
                            }
                        },1500);
                    } else {
                        setTimeout(function(){
                            $('div.cover-div').remove();
                            $('#modal-review-body').empty().addClass('text-center').html(data);
                            $('#review_send').css('display', 'none');
                        },1500);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

            $('div.phone-response-help').empty();
            $('div.email-response-help').empty();
            $('div.message-response-help').empty();
        }

    });
});




/*TESTS WHETHER STRING IS JSON OR NOT*/
function isJSON(data) {
    try {
        JSON.parse(data);
    }catch(e) {
        return false;
    }
    return true;
}


/*ADDING STYLES TO IMAGES INSIDE POSTS*/
$(document).ready(function(){
    var figures = $(".news-body").find('figure');

    $(figures).each(function(){

        var img = $(this).find('img');

        if($(this).hasClass('image-style-align-right')){
            $(img).attr('align', 'right');
            $(img).addClass('align-right-img img-responsive');
        } else if($(this).hasClass('image-style-align-left')){
            $(img).attr('align', 'left');
            $(img).addClass('img-responsive align-left-img');
        } else {
            $(img).addClass('img-responsive align-center-img');
        }
    });

    $(".news-body").css('text-align', 'justify');

});