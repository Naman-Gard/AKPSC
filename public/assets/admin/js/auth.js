let otp=0;
$('#login-form').on('submit', function (e) {

    e.preventDefault();

    let flag=otpValidation()
    $.each(this, function (i, element) {
        if (element.name == "password") {
            element.value = btoa(element.value);
        }
    })
    if(flag){
        e.currentTarget.submit();
    }

});

$('#get-otp').click(()=>{
    emailValidation()
})

function emailValidation() {
    let email = $('input[name=email]').val()
    let valid =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email.toLowerCase().match(valid)) {
        let data={
            'email':email,
            'password':btoa($('input[name=password]').val())
        }
        $.ajax({
            type: "GET",
            url: base_url + 'secure-admin/check/credentials/'+btoa(JSON.stringify(data)),
            success:function(response){
                if(response.status==='Invalid Credentials'){
                    $('#valid_email').html("Invalid Credentials");
                }
                else{
                    $('#valid_email').html("");
                    $('#verify-otp').removeClass('d-none')
                    if(!$('#login').hasClass('d-none')){
                        $('#login').addClass('d-none')
                    }
                    otpCreation(email)
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

function otpCreation(email){
    let string = '0123456789';
    let len = string.length;
    let OTP = ""

    for (let i = 0; i < 4; i++ ) {
        OTP += string[Math.floor(Math.random() * len)];
    }
    console.log(OTP)
    // $.ajax({
    //     type: "GET",
    //     headers: {
    //         'Access-Control-Allow-Origin': '*'
    //     },
    //     url: base_url + 'send/otp/'+btoa(email)+'/'+btoa(OTP),
    // })
    otp=OTP
    // console.log(otp)
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
    emailValidation()
})