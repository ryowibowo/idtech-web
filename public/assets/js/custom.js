// Preloader
$(document).ready(function () {
    setTimeout(function () {
        $("body").addClass("loaded");
    }, 500);
});
//  Owl Carousel

jQuery(document).ready(function ($) {
    $(".nonloop").owlCarousel({
        center: false,
        items: 10,
//        loop: true,
        margin: 10,
        nav: true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
        ],
        navContainer: ".main-contents .custom-nav",
        dots: false,
        responsive: {
            0: {
                items: 4,
            },
            600: {
                items: 5,
            },
            1000: {
                items: 10,
            },
        },
    });
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 15,
        items: 3,
        nav: true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
        ],
        navContainer: ".main-content .custom-nav",
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 3,
            },
        },
    });
});
//  Modal

$("#modal-otp").on("show.bs.modal", function () {
    $("#modal-login").modal("hide");
    $("#modal-konfirmasi").modal("hide");
});

$("#modal-daftar").on("show.bs.modal", function () {
    $("#modal-login").modal("hide");
});

$("#modal-reset").on("show.bs.modal", function () {
    $("#modal-login").modal("hide");
});

$("#modal-konfirmasi-reset").on("show.bs.modal", function () {
    $("#modal-reset").modal("hide");
});
$("#modal-sukses-daftar").on("show.bs.modal", function () {
    $("#modal-daftar").modal("hide");
});
$("#modal-option-payment").on("show.bs.modal", function () {
    $("#modal-payment").modal("hide");
});
$("#modal-payment").on("show.bs.modal", function () {
    $("#modal-option-payment").modal("hide");
});
$("#modal-payment2").on("show.bs.modal", function () {
    $("#modal-option-payment").modal("hide");
});
$("#modal-bayar").on("show.bs.modal", function () {
    $("#modal-payment2").modal("hide");
});

$(document).on("hidden.bs.modal", function () {
    if ($(".modal.show").length) {
        $("body").addClass("modal-open");
    }
});

//  Sticky Header
$(window).scroll(function () {
    if ($(document).scrollTop() > 0) {
        $(".navbar").addClass("affix");
    } else {
        $(".navbar").removeClass("affix");
    }
});

// Login Validation
setTimeout(() => {
    $(".email > input").focus();
}, 300);

$(".email > input").on("keydown", (event) => {
    if (event.which === 13 || event.keyCode === 13) {
        $(".email > input").blur();
        $(".next").click();
    }
});

$(".password > input").on("keydown", (event) => {
    if (event.which === 13 || event.keyCode === 13) {
        $(".login").click();
    }
});

$(".next").on("click", (event) => {
    let emailInput = $(".email > input").val();
    if (validateEmail(emailInput)) {
        event.preventDefault();
        $(".inputs").addClass("shift");
        $(".back").addClass("active-back");
        $(".email > input").css({
            border: "1px solid #cccccc",
        });

        $(".warning").empty();
        setTimeout(() => {
            $(".password > input").focus();
        }, 400);
    } else {
        event.preventDefault();
        $(".warning").empty();
        $(".email > input").css({
            border: "1px solid red",
        });

        $(".warning").append("Invalid Email Address");
    }
});

$(".back").on("click", (event) => {
    event.preventDefault();
    $(".inputs").removeClass("shift");
    $(".back").removeClass("active-back");
    setTimeout(() => {
        $(".email > input").focus();
    }, 300);
});

const validateEmail = (email) => {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};
// Login
// function doPreview()
// {
//     form=document.getElementById('idOfForm');
//     form.submit();
//     form.action='auth-index.html';
// }

// plus minus value cart
$(".btn-number").click(function (e) {
    e.preventDefault();

    fieldName = $(this).attr("data-field");
    type = $(this).attr("data-type");
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == "minus") {
            if (currentVal > input.attr("min")) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr("min")) {
                $(this).attr("disabled", true);
            }
        } else if (type == "plus") {
            if (currentVal < input.attr("max")) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr("max")) {
                $(this).attr("disabled", true);
            }
        }
    } else {
        input.val(0);
    }
});
$(".input-number").focusin(function () {
    $(this).data("oldValue", $(this).val());
});
$(".input-number").change(function () {
    minValue = parseInt($(this).attr("min"));
    maxValue = parseInt($(this).attr("max"));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr("name");
    if (valueCurrent >= minValue) {
        $(
            ".btn-number[data-type='minus'][data-field='" + name + "']"
        ).removeAttr("disabled");
    } else {
        alert("Sorry, the minimum value was reached");
        $(this).val($(this).data("oldValue"));
    }
    if (valueCurrent <= maxValue) {
        $(
            ".btn-number[data-type='plus'][data-field='" + name + "']"
        ).removeAttr("disabled");
    } else {
        alert("Sorry, the maximum value was reached");
        $(this).val($(this).data("oldValue"));
    }
});
$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if (
        $.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)
    ) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if (
        (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
        (e.keyCode < 96 || e.keyCode > 105)
    ) {
        e.preventDefault();
    }
});
