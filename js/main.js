$( document ).ready(function() {

    // validation
$(function() {
    $('#contact-form').validate({
        errorElement: "span",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "initials")
                error.insertAfter(".initials-label");
            else if (element.attr("name") == "tel")
                error.insertAfter(".tel-label");
            else if (element.attr("name") == "email")
                error.insertAfter(".email-label");
            else if (element.attr("name") == "city")
                error.insertAfter(".city-label");
            else if (element.attr("name") == "personal")
                error.insertAfter(".personal-label");
        },
        rules: {
            personal: {
                required: true
            },
            initials: {
                required: true,
                minlength: 2,
            },
            city: {
                required: true,
                minlength: 2
            },
            tel: {
                number: true,
                required: true,
                minlength: 7,
                maxlength: 15
            },

            email: {
                email: true
            }
        },
        messages: {
            initials: {
                required: "Поле обязательно к заполнению",
                minlength: "Введите не менее 2-х символов"
            },
            city: {
                required: "Поле обязательно к заполнению",
                minlength: "Введите не менее 2-х символов"
            },
            email: {
                required: "Поле обязательно к заполнению",
                email: "Необходим формат адреса email"
            },
            tel: {
                number: "Введите корректный номер телефона",
                required: "Поле обязательно к заполнению",
                minlength: "Номер должен состоять не менее, чем из 7 знаков",
                maxlength: "Номер не должен содержать более 15 знаков"
            },
            personal: {
                required: "Подтвердите согласие на обработку данных",
            },
        },

        submitHandler: function() {
            setTimeout(function() {
                $('#success').fadeIn('slow');
            }, 600);
            $('.form-head').fadeOut('slow');
            $('#contact-form').fadeOut('slow');
            // send(); call function to send email
        }
    });
});

// function to send email
    function send() {
        var form = $('#contact-form');
        var data = $(form).serialize();
        $.ajax({
            url: 'your_url_here.com', // Your url here
            data: data,
            type: 'POST',
            datatype: "html"
        }).done( function (data) {
            console.log(data); // optional
        }).fail( function (data) {
            console.log('Error: '+data); //optional
        });
    }
});

