@include('auth.includes.header')

<body className='snippet-body'>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="form">
                        <div class="left-side col-md-8">
                            <div class="left-heading">
                                <h3 style="color:#6a044b; font-size:26px; text-align:center"></h3>
                            </div>
                            <div class="steps-content">
                            </div>
                            <div class="steps-content">
                                <p style="color:#6a044b; font-size:12px">
                                    <br>
                                </p>
                            </div>
                            <ul class="progress-bar">
                            </ul>
                        </div>
                        <div class="right-side">
                            <div class="main active">
                                <div class="img-wrap text-center">
                                    <img src="{{asset('assets/images/ukpsc_logo.png')}}" width="150">
                                </div>
                                <div class="text">
                                </div>
                                <div class="input-text" id="login">
                                    @if(session('success'))
                                    <span class="text-danger">{{session('success')}}</span>
                                    @endif
                                    <form method="POST" action="{{route('login')}}" id="login-form">
                                        @csrf
                                        <div class="input-div">
                                            <label for="email" class="form-label">User ID / Email ID (यूज़र आईडी
                                                / ईमेल आईडी)</label>
                                            <input type="email" name="email" required autocomplete="off">
                                            <!-- <span>Institute ID / Email ID (संस्थान आईडी / ईमेल आईडी)</span> -->
                                        </div>
                                        <div class="input-div">
                                            <label for="email" class="form-label">Password (पासवर्ड)</label>
                                            <input type="password" name="password" required autocomplete="off">
                                            <!-- <span>Password (पासवर्ड)</span> -->
                                        </div>
                                        <div class="buttons">
                                            <button class="next_button">Submit</button>
                                        </div>
                                    </form>
                                    <p>
                                        <a id="forget-button">Forgot Password? (पासवर्ड भूल गए?)</a>
                                    </p>
                                    <p>
                                        
                                        <!-- <a id="register-here">Register Here! (यहां रजिस्टर करें!)</a> -->
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#registerModal">
                                            Don't have a UKPSC Registration? (यूकेपीएससी पंजीकरण नहीं है?)<br>
                                            Register Here! (यहां रजिस्टर करें!)
                                        </a>
                                    </p>
                                    
                                </div>

                                <div class="input-text d-none" id="forget-password">
                                    <form id="forget-form">
                                        @csrf
                                        <h2 class="text-white fw-bold text-center">Forget Password</h2>
                                        <div class="input-div">
                                            <p id="valid_forget_email" class="text-danger"></p>
                                            <label for="email" class="form-label">Email ID (ईमेल आईडी)</label>
                                            <input type="email" name="forget_email" required autocomplete="off">
                                            <!-- <span>Institute ID / Email ID (संस्थान आईडी / ईमेल आईडी)</span> -->
                                        </div>
                                        <div class="buttons">
                                            <button class="next_button">Proceed</button>
                                        </div>
                                    </form>
                                    <p>
                                        <!-- <a id="register-here">Register Here! (यहां रजिस्टर करें!)</a> -->
                                        <a type="button" id="back-to-login">
                                            Back To Login!
                                        </a>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header align-items-start">
            <div class="d-flex align-items-center">
                <div class="img-wrap text-center">
                    <img src="{{asset('assets/images/ukpsc_logo.png')}}" width="120">
                </div>
                <div>
                    <h3 class="text-white register-name">
                        Registration Form
                    </h3>
                </div>

            </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('register')}}" id="register-form" method="POST">
                @csrf
                <div class="input-div">
                    <label for="name" class="form-label">Name (नाम) <span class="red-feild">*</span> </label>
                    <input type="text" name="name" required autocomplete="off" />
                    <!-- <span>Name (नाम)</span> -->
                    <p class="text-danger" id="valid_name"></p>
                </div>
                <div class="input-div">
                    <label for="father_name" class="form-label">Father Name (पिता का नाम) <span class="red-feild">*</span></label>
                    <input type="text" name="father_name" required autocomplete="off" />
                    <!-- <span>Father Name (पिता का नाम)</span> -->
                    <p class="text-danger" id="valid_father_name"></p>
                </div>
                <div class="input-div">
                    <!-- <label>Date of Birth (जन्म की तारीख)</label> -->
                    <label for="dob" class="form-label">Date of Birth (जन्म की तारीख) <span class="red-feild">*</span></label>
                    <input type="text" name="dob" id="dob" required autocomplete="off" placeholder="dd/mm/yyyy"/>
                    <p class="text-danger" id="valid_dob"></p>
                </div>
                <div class="input-div">
                    <label>Gender</label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="male"
                                    id="male" />
                                <label class="form-check-label" for="flexRadioDefault1">Male </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender"
                                    value="female" id="female" />
                                <label class="form-check-label" for="flexRadioDefault1"> Female </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender"
                                    value="other" id="other" />
                                <label class="form-check-label" for="flexRadioDefault1"> Other </label>
                            </div>
                        </div>
                    </div>
                    <!-- <span>Gender (लिंग)</span> -->
                    <p class="text-danger" id="valid_gender"></p>
                </div>
                <div class="input-div">
                    <label for="category" class="form-label">Category (श्रेणी) <span class="red-feild">*</span></label>
                    <select required name="category" id="category">
                        <option value="">Select</option>
                        <option value="General">General</option>
                        <option value="OBC">OBC</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                    </select>
                    <!-- <input type="text" name="category" required autocomplete="off" /> -->
                    <!-- <span>Category (श्रेणी)</span> -->
                    <p class="text-danger" id="valid_category"></p>
                </div>
                <div class="input-div">
                    <label for="mobile" class="form-label">Mobile No. (मोबाइल नंबर) <span class="red-feild">*</span></label>
                    <input type="text" name="mobile" required autocomplete="off" />
                    <!-- <span>Mobile No. (मोबाइल नंबर)</span> -->
                    <p class="text-danger" id="valid_mobile"></p>
                </div>
                <div class="input-div">
                    <label for="reg_email" class="form-label">Email ID (ईमेल आईडी) <span class="red-feild">*</span></label>
                    <input type="email" name="reg_email" required autocomplete="off" />
                    <!-- <span>Email ID (ईमेल आईडी)</span> -->
                    <p class="text-danger" id="valid_email"></p>
                </div>
                <div class="input-div">
                    <label for="pass" class="form-label">Password (पासवर्ड) <span class="red-feild">*</span></label>
                    <input type="password" name="pass" required autocomplete="off" />
                    <p class="text-danger" id="valid_pass"></p>
                    <!-- <span>Password (पासवर्ड)</span> -->
                </div>
                <div class="input-div">
                    <label for="cnfrm_pass" class="form-label">Confirm Password (पासवर्ड पुष्टि करें) <span class="red-feild">*</span></label>
                    <input type="password" name="cnfrm_pass" required autocomplete="off" />
                    <!-- <span>Confirm Password (पासवर्ड पुष्टि करें)</span> -->
                </div>

                <div class="d-none" id="otp_input">
                    <label class="form-label">OTP</label>
                    <input type="text" name="otp" id="otp">
                    <p class="text-danger" id="valid_otp"></p>
                    <div id="ten-countdown"></div>
                    <div class="d-none" id="resend-otp">
                        <input class="next_button myBtn" type="button" id="resend-otp-btn" value="Resend OTP"/>
                    </div>
                </div>

                <div class="buttons mt-4">
                    <input class="next_button myBtn" type="button" id="get_OTP" value="Get OTP"/>
                    <button class="next_button d-none" id="register-btn">Register</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</body>

@include('auth.includes.footer')
<script>
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

        let flag = doValidation()

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
        if ($('input[name=mobile]').val() !== '') {
            if($('input[name=mobile]').val().length<10){
                flag.push(false)
                $('#valid_mobile').html("Please enter valid mobile");
            }
            else{
                $('#valid_mobile').html("");
            }
        }
        else{
            flag.push(false)
            $('#valid_mobile').html("Please enter valid mobile");
        }

        if ($('input[name=otp]').val() !== '') {
            flag.push(otpValidation())
        }
        else{
            flag.push(false)
            $('#valid_otp').html("Please enter valid otp");
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

        if ($('input[name=gender]:checked').length !== 0) {
            $('#valid_gender').html("");
            flag.push(true)
        } else {
            $('#valid_gender').html("Gender Field is Required");
            $('input[name=gender]').focus()
            flag.push(false)
        }

        $("#dob").blur(function(){
            val = $(this).val();
            val1 = Date.parse(val);
            if (isNaN(val1)==true && val!==''){
                $('#valid_dob').html("Please enter valid date");
            }
            else{
                $('#valid_dob').html("");
            }
        });

        return flag.includes(false) ? false : true
    }

    $('input[name=name]').keydown((e) => {

        var keyCode = (e.keyCode ? e.keyCode : e.which);
        if (keyCode > 47 && keyCode < 58) {
            e.preventDefault();
        }
    })

    $('input[name=mobile]').keydown((e) => {
        var keyCode = (e.keyCode ? e.keyCode : e.which);
        if (e.currentTarget.value.length == 10 && keyCode!==8)
            return false;
        
        if ((keyCode > 64 && keyCode < 91) || (keyCode > 96 && keyCode < 123)) {
            e.preventDefault();
        }
    })


    function emailValidation() {
        // let email=document.getElementById('email').value;
        let email = $('input[name=reg_email]').val()
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
                        $('#valid_email').html("This Email is already registered");
                        $('input[name=reg_email]').attr('readonly',false)
                        if(!$('#register-btn').hasClass('d-none')){
                            $('#register-btn').addClass('d-none')
                        }
                    }
                    else{
                        $('#valid_email').html("");
                        $('input[name=reg_email]').attr('readonly',true)
                        $('#get_OTP').addClass('d-none')
                        $('#register-btn').removeClass('d-none')
                        $('#otp_input').removeClass('d-none')
                        otpCreation(email)
                    }
                }
            })
        } else {
            $('#valid_email').html("Please enter valid email");
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

        $.ajax({
            type: "GET",
            headers: {
                'Access-Control-Allow-Origin': '*'
            },
            url: base_url + 'send/otp/'+btoa(email)+'/'+btoa(OTP),
        })
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
                $('input[name=reg_email]').attr('readonly',false)
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
        dateFormat: "dd/mm/yy",
        yearRange: '1957:2022'
    });

</script>