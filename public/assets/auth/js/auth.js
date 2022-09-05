let otp=0;
$('#login-form').on('submit', function (e) {

    e.preventDefault();
    $.each(this, function (i, element) {
        if (element.name == "password") {
            element.value = btoa(element.value);
        }
    })
    e.currentTarget.submit();

});

$('#forget-form').on('submit',function(e){
    e.preventDefault();
    doForgetValidation()
})

$('#register-form').on('submit', function (e) {

    e.preventDefault();

    let flag = otpValidation()

    if (flag) {
        $.each(this, function (i, element) {
            if (element.name == "pass") {
                element.value = btoa(element.value);
            }
            if (element.name == "cnfrm_pass") {
                element.value = btoa(element.value);
            }
        })

        e.currentTarget.submit();
    }

});

function doValidation() {
    let flag = [];
    $('#valid_otp').html("");

    if ($('input[name=name]').val() !== '') {
        $('#valid_name').html("");
    }
    else{
        flag.push(false)
        $('input[name=name]').focus();
        $('#valid_name').html("The field is Required");
    }

    if ($('input[name=father_name]').val() !== '') {
        $('#valid_father_name').html("");
    }
    else{
        flag.push(false)
        $('input[name=father_name]').focus();
        $('#valid_father_name').html("The field is Required");
    }

    if ($('input[name=dob]').val() !== '') {
        flag.push(dateIsValid($('input[name=dob]').val()))
    }
    else{
        flag.push(false)
        $('#valid_dob').html("The field is Required");
    }

    if ($('#category').val() !== '') {
            $('#valid_category').html("");
    }
    else{
        flag.push(false)
        $('#valid_category').html("The field is Required");
    }
    

    // if ($('input[name=otp]').val() !== '') {
    //     flag.push(otpValidation())
    // }
    // else{
    //     flag.push(false)
    //     $('#valid_otp').html("Please enter valid otp");
    // }

    if ($('input[name=mobile]').val() !== '') {
        if($('input[name=mobile]').val().length<10){
            flag.push(false)
            $('#valid_mobile').html("Please enter valid mobile");
        }
        else{
            // flag='true'
            $('#valid_mobile').html("");
        }
    }
    else{
        flag.push(false)
        $('#valid_mobile').html("Please enter valid mobile");
    }

    if ($('input[name=pass]').val() !== '') {
        if ($('input[name=pass]').val() === $('input[name=cnfrm_pass]').val()) {
            $('#valid_pass').html("");
            flag.push(true)
        } else {
            $('#valid_pass').html("Password & Confirm Password doesn't match");
            flag.push(false)
        }
    }
    else{
        flag.push(false)
        $('#valid_pass').html("The field is required");
    }

    if ($('input[name=gender]:checked').length !== 0) {
        $('#valid_gender').html("");
        flag.push(true)
    } else {
        $('#valid_gender').html("The field is Required");
        $('input[name=gender]').focus()
        flag.push(false)
    }

    return flag.includes(false) ? false : true
}

$('input[name=name]').keydown((e) => {

    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (!(keyCode >= 65 && keyCode <= 123)
                        && (keyCode != 32 && keyCode != 0)
                        && (keyCode != 48 && keyCode != 8)
                        && (keyCode != 9)) {
        e.preventDefault();
    }
})

$('input[name=father_name]').keydown((e) => {

    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (!(keyCode >= 65 && keyCode <= 123)
                        && (keyCode != 32 && keyCode != 0)
                        && (keyCode != 48 && keyCode != 8)
                        && (keyCode != 9)) {
        e.preventDefault();
    }
})

$('input[name=mobile]').keydown((e) => {
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (e.currentTarget.value.length == 10 && keyCode!==8)
        return false;
    
    return e.ctrlKey || e.altKey 
                || (47<e.keyCode && e.keyCode<58 && e.shiftKey==false) 
                || (95<e.keyCode && e.keyCode<106)
                || (e.keyCode==8) || (e.keyCode==9) 
                || (e.keyCode>34 && e.keyCode<40) 
                || (e.keyCode==46)
})


function emailValidation() {
    // let email=document.getElementById('email').value;
    let flag=doValidation()
    let email = $('input[name=reg_email]').val()
    let valid =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email.toLowerCase().match(valid) && flag) {
        let data={
            'email':email,
            'mobile':$('input[name=mobile]').val(),
            'name':$('input[name=name]').val(),
            'father_name':$('input[name=father_name]').val(),
            'dob':$('input[name=dob]').val()
        }
        $.ajax({
            type: "GET",
            url: base_url + 'check/isEmailRegistered/'+btoa(JSON.stringify(data)),
            success:function(response){
                // console.log(response.status)
                $('input[name=reg_email]').attr('readonly',false)
                $('input[name=mobile]').attr('readonly',false)

                if(response.status==='User Already Exist'){
                    $('#valid_name').html("This User is already registered");
                    $('#valid_email').html("");
                    $('#valid_mobile').html("");
                    // if(!$('#register-btn').hasClass('d-none')){
                    //     $('#register-btn').addClass('d-none')
                    // }
                }
                else if(response.status==='Already Exist'){
                    $('#valid_email').html("This Email is already registered");
                    $('#valid_mobile').html("This Mobile is already registered");
                    $('#valid_name').html("");
                    // if(!$('#register-btn').hasClass('d-none')){
                    //     $('#register-btn').addClass('d-none')
                    // }
                }
                else if(response.status==='Mobile Already Exist'){
                    $('#valid_email').html("");
                    $('#valid_name').html("");
                    $('#valid_mobile').html("This Mobile is already registered");
                    // if(!$('#register-btn').hasClass('d-none')){
                    //     $('#register-btn').addClass('d-none')
                    // }
                }
                else if(response.status==='Email Already Exist'){
                    $('#valid_email').html("This Email is already registered");
                    $('#valid_mobile').html("");
                    $('#valid_name').html("");
                    // if(!$('#register-btn').hasClass('d-none')){
                    //     $('#register-btn').addClass('d-none')
                    // }
                }
                else{
                    $('#valid_email').html("");
                    $('#valid_mobile').html("");
                    $('#valid_name').html("");
                    $('input[name=reg_email]').attr('readonly',true)
                    $('input[name=mobile]').attr('readonly',true)
                    // $('#get_OTP').addClass('d-none')
                    // $('#register-btn').removeClass('d-none')
                    // $('#otp_input').removeClass('d-none')

                    $('.verify-otp').removeClass('d-none')
                    if(!$('.register-data').hasClass('d-none')){
                        $('.register-data').addClass('d-none')
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

$('#get_OTP').click(()=>{
    emailValidation()
})

function otpCreation(email){
    let string = '0123456789';
    let len = string.length;
    let OTP = ""

    for (let i = 0; i < 4; i++ ) {
        OTP += string[Math.floor(Math.random() * len)];
    }
    // console.log(OTP)
    // $.ajax({
    //     type: "GET",
    //     headers: {
    //         'Access-Control-Allow-Origin': '*'
    //     },
    //     url: base_url + 'send/otp/'+btoa(email)+'/'+btoa(OTP),
    // })
    otp='1234'
    // console.log(otp)
    countdown( "ten-countdown", 5, 0 );
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
            $('input[name=reg_email]').attr('readonly',false)
            $('input[name=mobile]').attr('readonly',false)
            if(!$('#register-btn').hasClass('d-none')){
                $('#register-btn').addClass('d-none')
            }
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
    $('#register-btn').removeClass('d-none')
    emailValidation()
})

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

$('#forget-button').click(()=>{
    if(!$('#login').hasClass('d-none')){
        $('#login').addClass('d-none')
    }
    $('#valid_forget_email').html("");
    $('#forget-password').removeClass('d-none')
})

$('#back-to-login').click(()=>{
    if(!$('#forget-password').hasClass('d-none')){
        $('#forget-password').addClass('d-none')
    }
    $('#login').removeClass('d-none')
})

function doForgetValidation(){
    let email = $('input[name=forget_email]').val()
    let valid =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (email.toLowerCase().match(valid)) {
        
        $.ajax({
            type: "GET",
            headers: {
                'Access-Control-Allow-Origin': '*'
            },
            url: base_url + 'check/isEmailRegistered/'+btoa(email),
            success:function(response){
                if(response.status==='Already Exist'){
                    sendResetLink(email)
                }
                else{
                    $('#valid_forget_email').html("Unauthorized User");
                    $('input[name=forget_email]').val('')
                }
            }
        })
    } else {
        $('#valid_forget_email').html("Please enter valid email");
    }
}

function sendResetLink(email){
    $.ajax({
        type: "GET",
        headers: {
            'Access-Control-Allow-Origin': '*'
        },
        url: base_url + 'send/reset/link/'+btoa(email),
        success:function(response){
            if(response.status==='Success'){
                $('#valid_forget_email').html("Password Reset Link is sent to registered Email");
            }
            else{
                $('#valid_forget_email').html("Unauthorized User");
            }
            $('input[name=forget_email]').val('')
        }
    })
}

$("#dob").datepicker({
    changeMonth: true,
    changeYear: true,
    format: 'dd/mm/yyyy'
});


$('document').ready(()=>{
    $("#registerModal").modal({
        backdrop: 'static',
        keyboard: false
    });

    // $("#dob").change(function(){
    //     val = $(this).val();
    //     console.log(val)
    //     val1 = Date.parse(val);
    //     if (isNaN(val1)==true && val!==''){
    //         $('#valid_dob').html("Please enter valid date");
    //     }
    //     else{
    //         $('#valid_dob').html("");
    //     }
    // });
})

function dateIsValid(dateStr){
    const regex = /^\d{2}\/\d{2}\/\d{4}$/;

    if (dateStr.match(regex) === null) {
        $('#valid_dob').html('Please enter valid date')
        return false;
    }

    const [day, month, year] = dateStr.split('/');

    // 👇️ format Date string as `yyyy-mm-dd`
    const isoFormattedStr = `${year}-${month}-${day}`;

    const date = new Date(isoFormattedStr);

    const timestamp = date.getTime();

    if (typeof timestamp !== 'number' || Number.isNaN(timestamp)) {
        $('#valid_dob').html('Please enter valid date')
        return false;
    }

    if (parseInt(year)>=2022) {
        $('#valid_dob').html('Please enter valid date')
        return false;
    }
    $('#valid_dob').html('')
    return true;
}
