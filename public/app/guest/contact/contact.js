
jQuery.validator.addMethod("validateScript", function (value, element) {
    return !(value.includes("script>") ||
        value.includes("script&gt;") ||
        value.includes("<?") ||
        value.includes("&lt;?"));
}, "Vui lòng nhập đúng định dạng chữ");
jQuery.validator.addMethod("validatePhone", function (value, element) {
    if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(value)) {
        return true;
    } else {
        return false;
    };
}, "Vui lòng nhập đúng định dạng số điện thoại");
jQuery.validator.addMethod("validateEmail", function (value, element) {
    if (this.optional(element) || /^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$/.test(value)) {
        return true;
    } else {
        return false;
    };
}, "Vui lòng nhập đúng định dạng email");
$('#contact-form').validate({
    rules: {
        contact_name: {
            required: true,
            validateScript: true,
            maxlength: 150
        },
        contact_phone: {
            required: true,
            validatePhone: true,
            validateScript: true,
            minlength: 10,
            maxlength: 10
        },
        contact_email: {
            required: false,
            validateEmail: true,
            maxlength: 50
        },
        contact_content: {
            required: true,
            validateScript: true,
            maxlength: 255
        }

    },
    messages: {
        contact_name: {
            required: "Tên không được trống !",
            maxlength: "Tên không quá 150 ký tự !"
        },
        contact_phone: {
            required: "Số điện thoại không được trống !",
            minlength: "Vui lòng nhập đủ 10 ký tự",
            maxlength: "Vui lòng nhập tối đa 10 ký tự"
        },
        contact_email: {
            maxlength: "Vui lòng nhập tối đa 50 ký tự"
        },
        contact_content: {
            required: "Nội dung không được trống !",
            maxlength: "Vui lòng nhập tối đa 255 ký tự"
        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function (e) {
        // var contact = JSON.parse(localStorage.getItem("contact"));
        // if( contact === null){
        //     contact = [];
        //     contact.push({
        //         yourIP: myIP,
        //         contact_name: $('#contact_name').val(),
        //         contact_email: $('#contact_email').val(),
        //         contact_content: $('#contact_content').val()
        //     });
        // }
        // localStorage.setItem("contact", JSON.stringify(contact));
        checkCaptcha();
    }

});
document.getElementById("div_submitContact").style.display = "none";
document.getElementById("captcha-form").style.display = "none";

document.getElementById("sendContact").onclick = function (event) {
    event.preventDefault();
    document.getElementById("captcha-form").style.display = "block";
    document.getElementById("div_submitContact").style.display = "block";
    document.getElementById("div_sendContact").style.display = "none";
}
var num1 = Math.floor(Math.random() * 10);
var num2 = Math.floor(Math.random() * 10);
var result = num1 + num2;
document.getElementById("captcha-name").innerText = "Đáp án phép tính: " + num1 + "+" + num2 + "=?";

function checkCaptcha() {
    var valCaptcha = document.getElementById("captcha-result").value;
    if (valCaptcha == '') {
        toastr.warning("Bạn chưa nhập Captcha!");
        return false;
    }
    if (result == valCaptcha) {
        submitContact();
        return true;
    } else {
        toastr.warning("Bạn nhập sai Captcha!");
        return false;
    }
}
function submitContact() {
    $('#submitContact').text("Đang gửi liên hệ...")
    $('#submitContact').prop("disabled", true);
    $.ajax({
        url: url_submit_contact,
        data: {
            contact_name: $('#contact_name').val(),
            contact_phone: $('#contact_phone').val(),
            contact_content: $('#contact_content').val(),
            contact_email: $('#contact_email').val()
        },
        type: 'POST',
        dataType: 'JSON',
        success: function (data) {
            $('#submitContact').prop("disabled", false);
            $('#submitContact').text("Gửi ngay")
            toastr.success("Gửi liên hệ thành công!");
            window.location.href = "./";
        },
        error: function (error) {
            console.log("Lỗi");
            console.log(error);
        }
    });
}