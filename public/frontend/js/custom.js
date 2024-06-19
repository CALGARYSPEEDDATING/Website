(function ($) {
  "use strict";

//Home Testimonial Carousel

$(".owl-carousel").owlCarousel({
  loop: true,
  margin: 55,
  autoplay: true,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: false
    },
    600: {
      items: 1,
      nav: false
    },
    1000: {
      items: 1,
      nav: false,
      loop: false,
      dots: false,

    }
  }
});

//Bootstrap 4 DatePicker

$('#datepicker').datepicker({
  orientation: 'bottom'
});
$('#datepicker_2').datepicker({
  orientation: 'bottom'
});


  /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    // var startdate = moment();
    // var checkdate = startdate.subtract(18, "years");
    // console.log(checkdate);
    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    // Form

    $("#newsletter").validate();
    $("#signin-form").validate();
   
    var form = $("#signup-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
             element.before(error); 
        },
        rules: {
            first_name : {
                required: true,
            },
            last_name : {
                required: true,
            },
            gender :  {
                required: true,
            },
            password :  {
                required: true,
            },
            password_confirmation: {
                equalTo: "#password"
            },
            birth_date : {
                required: true,
            },
            birth_month : {
                required: true,
            },
            birth_year : {
                required: true,
            },
            phone : {
                required: true,
            },
            matches_contact : {
                required: true,
            },
            agree : {
                required: true,
            },



        },
        onfocusout: function(element) {
            $(element).valid();
        },
        highlight : function(element, errorClass, validClass) {
            $(element.form).find('.actions').addClass('form-error');
            $(element).removeClass('valid');
            $(element).addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element.form).find('.actions').removeClass('form-error');
            $(element).removeClass('error');
            $(element).addClass('valid');
        }
    });
    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        labels: {
            previous : 'Previous',
            next : 'Next',
            finish : 'Submit',
            current : ''
        },
        titleTemplate : '<span class="title">#title#</span>',
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
          //  var form = $(this);
             var formData = $(this).serialize().split("&");
                console.log("You entered:");

                $.each(formData, function(index, value){
                  value = value.split("=");

                  // Append to div instead of logging to console
                  console.log(value[0] + ": " + value[1]);
                  if(value[0]==='gender' && value[1]==1)
                  {
                     $("."+value[0]).text('Female');
                  }
                  else if(value[0]==='gender' && value[1]==0){
                    $("."+value[0]).text('Male');
                  }
                  else if(value[0]==='email' ){
                      $("."+value[0]).text(value[1].replace("%40", "@")); 

                  }
                  else{

                    $("."+value[0]).text(value[1]);                    
                  }


                })
            // Submit form input
            $('#exampleModal').modal('show');
            $('#confirm').on('click' ,function(e){
                e.preventDefault();
                $('#exampleModal').modal('hide');
                 form.submit();
            });
            return;

           
            // console.log(form);
            // alert(event);
        },
        // onInit : function (event, currentIndex) {
        //     event.append('demo');
        // }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });


    $.dobPicker({
        daySelector: '#birth_date',
        monthSelector: '#birth_month',
        yearSelector: '#birth_year',
        dayDefault: 'Day',
        monthDefault: 'Month',
        yearDefault: 'Year',
        minimumAge: 18,
        maximumAge: 120
    });

   

})(jQuery);