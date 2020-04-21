var clientSwiper = new Swiper('.clients-swiper', {
    spaceBetween: 0,
    loop: true,
    slidesPerView: 5,
    autoplay: {
        delay: 2000,
    },
    breakpoints: {
        // when window width is <= 320px
        320: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // when window width is <= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        // when window width is <= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 30
        }
    }

});

var newsSwiper = new Swiper('.news-swiper', {
    spaceBetween: 30,
    loop: true,
    slidesPerView: 4,
    autoplay: {
        delay: 3500,
    },
    breakpoints: {
        // when window width is <= 320px
        320: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // when window width is <= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        // when window width is <= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 30
        }
    }

});

var newsSwiper = new Swiper('.use-case-swiper', {
    spaceBetween: 30,
    loop: true,
    slidesPerView: 1,
    autoplay: {
        delay: 2000,
    },

});


$(document).ready(function () {

    // Captcha();
    // Captcha1();
    var headerHeight = $('header').outerHeight();

    $('.banner').css({ 'height': 'calc(100vh - ' + headerHeight + 'px)' });

    // $(window).scroll(function () {

    //     if($(this).scrollTop() > 200){
    //         $('header').addClass('sticky animated fadeInDown');    
    //     }else{
    //         $('header').removeClass('sticky fadeInDown');
    //     }       
    // });

    var containerPadding = (($(window).width()) - 1200) / 2;
    console.log(containerPadding);

    $('.left-container-pad').css('padding-left', containerPadding + 'px');

    $(".button-collapse").sideNav({
        menuWidth: 250,
    });
    var pageHeadHeight = $('.page-head-block').innerHeight();

    $('.page-head-block').css('top', - + pageHeadHeight + 'px');
    $('.modal').modal();

    

    // $('.frm-submit').on('submit', function (e) {
    //     // var reCaptchaResponse = grecaptcha.getResponse();
    //     if (validateform()) {
    //         var newHtml = '<svg class="image-upload-spinner-container gLL" width="30px" height="30px" viewBox="0 0 52 52"><circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="5px"></circle></svg>';
    //         e.preventDefault();
    //         var current = $(this);
    //         var form_data = new FormData(current[0]);
    //         var sbtBtn = current.find('button[type="submit"]');
    //         var oldText = sbtBtn.html();
    //         sbtBtn.html(newHtml);
    //         sbtBtn.prop('disabled', true);
    //         $.ajax({
    //             url: 'api-request.php',
    //             type: 'POST',
    //             data: form_data,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             dataType: 'JSON',
    //             success: function (response) {
    //                 if (response.StatusCode == 200) {
    //                     Materialize.toast('Your request is successfully submitted!', 3000);
    //                     $('.modal').modal('close');
    //                 }
    //                 else if (response.StatusCode == 404) {
    //                     Materialize.toast('Your form not submitted please try again', 3000);
    //                 }
    //                 sbtBtn.prop('disabled', false);
    //                 sbtBtn.html(oldText);
    //                 grecaptcha.reset();
    //                 $('.frm-submit').each(function () {
    //                     this.reset();
    //                 });
    //             }
    //         });
    //     } else {
    //         e.preventDefault();
    //         Materialize.toast('Please confirm that you are not a robot!', 3000);
    //     }
    // });

    // $('.frm-submit1').on('submit', function (e) {
    //     if (ValidCaptcha()) {
    //         var newHtml = '<svg class="image-upload-spinner-container gLL" width="30px" height="30px" viewBox="0 0 52 52"><circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="5px"></circle></svg>';
    //         e.preventDefault();
    //         var current = $(this);
    //         var form_data = new FormData(current[0]);
    //         var sbtBtn = current.find('button[type="submit"]');
    //         var oldText = sbtBtn.html();
    //         sbtBtn.html(newHtml);
    //         sbtBtn.prop('disabled', true);
    //         $.ajax({
    //             url: 'api-request.php',
    //             type: 'POST',
    //             data: form_data,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             dataType: 'JSON',
    //             success: function (response) {
    //                 if (response.StatusCode == 200) {
    //                     Materialize.toast('Your request is successfully submitted!', 3000);
    //                     $('.modal').modal('close');

    //                 }
    //                 else if (response.StatusCode == 404) {
    //                     Materialize.toast('Your form not submitted please try again', 3000);
    //                 }
    //                 Captcha();
    //                 sbtBtn.prop('disabled', false);
    //                 sbtBtn.html(oldText);
    //                 $('.frm-submit1').each(function () {
    //                     this.reset();
    //                 });
    //                 close_model();
    //             }
    //         });
    //     } else {
    //         e.preventDefault();
    //         Materialize.toast('Please enter correct text!', 3000);
    //     }
    // });

    // $('.frm-submit2').on('submit', function (e) {
    //     if (ValidCaptcha1()) {
    //         var newHtml = '<svg class="image-upload-spinner-container gLL" width="30px" height="30px" viewBox="0 0 52 52"><circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="5px"></circle></svg>';
    //         e.preventDefault();
    //         var current = $(this);
    //         var form_data = new FormData(current[0]);
    //         var sbtBtn = current.find('button[type="submit"]');
    //         var oldText = sbtBtn.html();
    //         sbtBtn.html(newHtml);
    //         sbtBtn.prop('disabled', true);
    //         $.ajax({
    //             url: 'api-request.php',
    //             type: 'POST',
    //             data: form_data,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             dataType: 'JSON',
    //             success: function (response) {
    //                 if (response.StatusCode == 200) {
    //                     Materialize.toast('Your request is successfully submitted!', 3000);
    //                     $('.modal').modal('close');
    //                     $("#divtxtarea").removeClass("sec_apiinfo");

    //                     $('#btn_json').attr("disabled", false);
    //                     $('#btn_xml').attr("disabled", false);
    //                     SetSession("isLogged", "true");
    //                 }
    //                 else if (response.StatusCode == 404) {
    //                     Materialize.toast('Your form not submitted please try again', 3000);
    //                 }
    //                 Captcha1();
    //                 sbtBtn.prop('disabled', false);
    //                 sbtBtn.html(oldText);
    //                 $('.frm-submit2').each(function () {
    //                     this.reset();
    //                 });
    //             }
    //         });
    //     } else {
    //         e.preventDefault();
    //         Materialize.toast('Please enter correct text!', 3000);
    //     }
    // });

    $('.modal-close').click(function () {
        $('.modal').modal('close');
    });
});

function close_model(e) {
    $('.modal').modal('close');
}

$(document).ready(function () {
    var flag = GetSession("isLogged")
    if (flag==="true") {
        $("#divtxtarea").removeClass("sec_apiinfo");

        $('#btn_json').attr("disabled", false);
        $('#btn_xml').attr("disabled", false);
        $('#codesnippet_json').show();
        $('#codesnippet_xml').hide();
    }
    else {
        $('#btn_json').attr("disabled", "disabled");
        $('#btn_xml').attr("disabled", "disabled");

        $('#codesnippet_json').show();
        $('#codesnippet_xml').hide();
    }
    

    $("#btn_json").click(function () {
        $('#codesnippet_json').show();
        $('#codesnippet_xml').hide();
    });

    $("#btn_xml").click(function () {
        $('#codesnippet_json').hide();
        $('#codesnippet_xml').show();
    });
});

function validate() {

    var name = $('#name').val();
    var cname = $('#cname').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var message = $('#message').val();

    if (name == null || name == "") {
        Materialize.toast('Please enter your name!', 3000);
        return false;
    }
    if (email == null || email == "") {
        Materialize.toast('Please enter email!', 3000);
        return false
    }
    return true;
}

function validateform() {
    var captcha_response = grecaptcha.getResponse();
    if (captcha_response.length == 0) {
        // Captcha is not Passed
        return false;
    }
    else {
        // Captcha is Passed
        return true;
    }
}

// function Captcha() {
//     var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
//     var i;
//     for (i = 0; i < 6; i++) {
//         var a = alpha[Math.floor(Math.random() * alpha.length)];
//         var b = alpha[Math.floor(Math.random() * alpha.length)];
//         var c = alpha[Math.floor(Math.random() * alpha.length)];
//         var d = alpha[Math.floor(Math.random() * alpha.length)];
//         var e = alpha[Math.floor(Math.random() * alpha.length)];
//         var f = alpha[Math.floor(Math.random() * alpha.length)];
//         var g = alpha[Math.floor(Math.random() * alpha.length)];
//     }
//     var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;
//     document.getElementById("mainCaptcha").value = code
// }
// function ValidCaptcha() {
//     var string1 = removeSpaces(document.getElementById('mainCaptcha').value);
//     var string2 = removeSpaces(document.getElementById('txtInput').value);
//     if (string1 === string2) {
//         return true;
//     }
//     else {
//         return false;
//     }
// }
function removeSpaces(string) {
    return string.split(' ').join('');
}


// function Captcha1() {
//     var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
//     var i;
//     for (i = 0; i < 6; i++) {
//         var a = alpha[Math.floor(Math.random() * alpha.length)];
//         var b = alpha[Math.floor(Math.random() * alpha.length)];
//         var c = alpha[Math.floor(Math.random() * alpha.length)];
//         var d = alpha[Math.floor(Math.random() * alpha.length)];
//         var e = alpha[Math.floor(Math.random() * alpha.length)];
//         var f = alpha[Math.floor(Math.random() * alpha.length)];
//         var g = alpha[Math.floor(Math.random() * alpha.length)];
//     }
//     var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;
//     document.getElementById("mainCaptcha1").value = code
// }
// function ValidCaptcha1() {
//     var string1 = removeSpaces(document.getElementById('mainCaptcha1').value);
//     var string2 = removeSpaces(document.getElementById('txtInput1').value);
//     if (string1 === string2) {
//         return true;
//     }
//     else {
//         return false;
//     }
// }
function removeSpaces1(string) {
    return string.split(' ').join('');
}

function SetSession(key, value) {
    return sessionStorage.setItem(key, JSON.stringify(value));
}

function GetSession(key) {
    return JSON.parse(sessionStorage.getItem(key));
}

function RemoveSession(key) {
    return sessionStorage.removeItem(key);
}

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
