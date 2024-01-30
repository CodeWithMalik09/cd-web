window.onload = () => {
    Array.of($(".wishbtn")).forEach((btn) => {
        btn.on('click', (e) => {
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "method": "POST",
                    'url': "/addtowishlist",
                    'data': { 'wish_id': e.target.dataset.id, 'type': e.target.dataset.type },
                    'success': (res) => {
                        if (res['message'] === 'success') {
                            // $(this).css('color','red');
                            e.target.style.color = "red";
                        } else {
                            // $(this).css('color','grey');
                            e.target.style.color = "grey";
                        }
                    }
                }
            )
        })
    });
}


//Dialog Close
$('.dialog__c-f-btn-close').click(() => {
    $('.dialog').toggle();
    $('.dialog__c-c').html('');
})

function showAlertDialog(text) {
    $('.dialog').toggle();
    $('.dialog__c-c').html(text);
}


//ShareButton
// function shareMe(link){
//     // console.log(name);
//     if (navigator.share) {
//     navigator.share({
//         title: 'Coaching Detail',
//         url: link,
//     }).then(() => {
//         console.log('Thanks for sharing!');
//     })
//     .catch(console.error);
//     } else {
//         // shareDialog.classList.add('is-open');
//     }
// }



//Coaching registration gallery 
$('#logo').on('change', (e) => {
    let reader = new FileReader();
    reader.onload = (res) => {
        $('#displayimg').html(`<img src='${res.target.result}'>`);
    }
    reader.readAsDataURL(e.target.files[0]);
})

$('#thumbnail').on('change', (e) => {
    let reader = new FileReader();
    reader.onload = (res) => {
        $('#displaythumbnail').html(`<img src='${res.target.result}'>`);
    }
    reader.readAsDataURL(e.target.files[0]);
})

$('#galleryimage').on('change', (e) => {
    $('#gallery').html('');
    Array.from(e.target.files).forEach((file) => {
        let reader = new FileReader();
        reader.onload = (res) => {

            $('#gallery').append(`<img src='${res.target.result}'>`);
        }
        reader.readAsDataURL(file);
    })
})


//Mobile Drawer Hamburg
$('.h__c-md-db').click(() => {
    if ($('.h__c-md-d').css('width') === "0px") {
        $('.h__c-md-d').css({ 'width': '100%', 'height': 'auto' });
        $('.h__c-md').css('bottom', '0');
    } else {
        $('.h__c-md-d').css({ 'width': '0', 'height': '0' });
        $('.h__c-md').css('bottom', 'auto');
    }
})

let canSend = true;

//send OTP
function sendotp(type = "login") {
    let phone;
    if (type == "login") {
        phone = $("#lphone").val();
        $("#lpl").text('Enter OTP *')
        $('#lpassword').attr('placeholder', 'Enter 4 Digit OTP');
        $('#lpassword').attr('name', 'otp');
        $('.forget').hide();
    } else {
        phone = $("#rphone").val();
        $("#rpl").text('Enter OTP *')
        $('#rpassword').attr('placeholder', 'Enter 4 Digit OTP');
        $('#rpassword').attr('name', 'otp');
    }
    // $("#otp_send_notification").toggle();

    if (canSend) {
        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/send-otp",
                method: "POST",
                data: { "phone": phone, "type": type },
                success: (res) => {
                    if (res.status == "success") {
                        $('.otp_btn').css({ 'background-color': 'gray' })
                        $("#otp_send_notification").toggle();
                        canSend = false;
                    } else {
                        showAlertDialog(res.message);
                    }
                }
            }
        )

    }
    setTimeout(() => {
        $('.otp_btn').css({ 'background-color': '#ff6600' })
        canSend = true;
    }, 25000)
}


//Single Coaching Screen

function viewImage(e) {
    $('.imgcarousel__c-img').attr('src', e.src);
    $('.imgcarousel').show();
    $('body').css('overflow', 'hidden');
}

function showPrevImage() {
    let indexOfCurrentImage = images.indexOf($('.imgcarousel__c-img').attr('src'));
    $('.imgcarousel__c-img').attr('src', images[indexOfCurrentImage - 1]);
    $('.imgcarousel').show();
    $('body').css('overflow', 'hidden');
}
function showNextImage(e) {
    let indexOfCurrentImage = images.indexOf($('.imgcarousel__c-img').attr('src'));
    $('.imgcarousel__c-img').attr('src', images[indexOfCurrentImage + 1]);
    $('.imgcarousel').show();
    $('body').css('overflow', 'hidden');
}

function closeViewImage() {
    $('.imgcarousel').hide();
    $('body').css('overflow', 'auto');
}