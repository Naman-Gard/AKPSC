let otp=0;

$(document).ready(function() {
  captchaGenerate()
})

function captchaGenerate(){
  var string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  var len = string.length;
  let captcha=""
  for (let i = 0; i < 6; i++ ) {
      captcha += string[Math.floor(Math.random() * len)];
  }
  $('#html_captcha_code').html(captcha);
  $('#html_captcha_code').bind("copy cut paste contextmenu", function(e) {
    e.preventDefault();
    return false;
  });

  $('#captcha').val(captcha);
}

$('.refreshCaptcha').click(()=>{
    captchaGenerate()
})

$('#login-form').on('submit', function (e) {

    e.preventDefault();

    let flag=otpValidation()
    $.each(this, function (i, element) {
        if (element.name == "password" || element.name == "captcha" ||element.name == "captcha_code") {
            element.value = encode(element.value);
        }
    })
    if(flag){
        e.currentTarget.submit();
    }

});

$('#get-otp').click(()=>{
    emailValidation()
    $('#status').addClass('d-none')
})

function emailValidation() {
    let email = $('input[name=email]').val()
    let valid =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email.toLowerCase().match(valid) && $('input[name=captcha_code]').val()!=='') {
        $('#valid_captcha').html('')
        $('#valid_email').html("");
        let data={
            'email':email,
            'password':btoa(btoa($('input[name=password]').val())),
            'captcha_code':btoa(btoa($('input[name=captcha_code]').val())),
            'captcha':btoa(btoa($('input[name=captcha]').val()))
        }
        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify({"_token":token,data:encode(JSON.stringify(data))}),
            url: base_url + 'ceoadmin/check/credentials',
            success:function(response){
                if(response.status==='Invalid Credentials'){
                    $('#valid_email').html("Invalid Credentials");
                    captchaGenerate()
                }
                else if(response.status==='Captcha is not correct'){
                    $('#valid_captcha').html(response.status)
                    captchaGenerate()
                }
                else{
                    $('#valid_email').html("");
                    $('#verify-otp').removeClass('d-none')
                    if(!$('#login').hasClass('d-none')){
                        $('#login').addClass('d-none')
                    }
                    otpCreation(response.data)
                }
            }
        })
    } else {
        if(email.toLowerCase().match(valid)){
            $('#valid_email').html("");
        }
        else{
            $('#valid_email').html("Please enter valid email");
        }

        if($('input[name=captcha_code]').val()===''){
            $('#valid_captcha').html("This field is required");
        }
    }
}

function otpValidation(){
    const generatedOTP=$('#otp').val()
    if(generatedOTP.length===4){
        if(generatedOTP===otp){
            $('#valid_otp').html("");
            return true
        }
        else{
            $('#valid_otp').html("Please enter valid otp");
            return false
        }
    }
    else{
        $('#valid_otp').html("Please enter valid otp");
        return false
    }
}

function otpCreation(data){
    // let string = '0123456789';
    // let len = string.length;
    // let OTP = ""

    // for (let i = 0; i < 4; i++ ) {
    //     OTP += string[Math.floor(Math.random() * len)];
    // }
    // $.ajax({
    //     type: "GET",
    //     headers: {
    //         'Access-Control-Allow-Origin': '*'
    //     },
    //     url: base_url+'ceoadmin/send/otp/'+mobile+'/'+btoa(OTP),
    // })
    otp=atob(atob(data))
    // otp='1234'
    countdown( "ten-countdown", 4, 0 );
}

function countdown( elementName, minutes, seconds )
{
    let element, endTime, hours, mins, msLeft, time;

    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
        msLeft = endTime - (+new Date);
        if ( msLeft < 1000 ) {
            element.innerHTML="";
            $('#resend-otp').removeClass('d-none')
            $('#valid_otp').html("");
            otp=0
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }

    element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}

$('#resend-otp-btn').click(()=>{
    $('#resend-otp').addClass('d-none')
    $('#valid_otp').html('')
    $('#otp').val('')
    emailValidation()
})