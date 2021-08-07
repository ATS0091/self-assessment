$(function () {
    // $.validator.setDefaults({
    //   submitHandler: function () {
    //     alert( "Form successful submitted!" );
    //   }
    // });
    $("#employee").validate({
        rules: {
            name: {
                required: true,
                text: false,
            },
            email: {
                required: true,
                email: true,
            },
            designation: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please provide a name",
                text: "Your name must be character",
            },
            email: {
                required: "Please enter a email address",
                email: "Please enter a vaild email address",
            },
            designation: "Please select a designation",
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });
});
