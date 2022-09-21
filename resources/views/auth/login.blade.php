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
                                    <img src="{{asset('assets/images/ukpsc_logo.png')}}" width="120">
                                </div>
                                <div class="text">
                                </div>
                                <div class="input-text" id="login">
                                    <p>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#registerModal" class="new-user animate-charcter">
                                        <img src="{{asset('assets/images/left-hand-cursor.png')}}" class="left-thumb">  New User Click Here! <img src="{{asset('assets/images/right-hand-cursor.png')}}" class="right-thumb">
                                        </a>
                                    </p>
                                    @if(session('success'))
                                    <span class="text-danger mt-3">{{session('success')}}</span>
                                    @endif

                                    <!-- <input type="hidden" name="token" id="token" value={{csrf_token()}}> -->
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

                                        <div class="form-group row mb-4">
                                            <div class="col-lg-12 col-xl-5 col-md-5">
                                                <div class="captcha-wrap d-flex align-items-center">
                                                    <p class="captcha-code" id="html_captcha_code"></p>
                                                    <a class="ms-2" onclick="captchaGenerate()">
                                                        <img src="{{asset('assets/images/refresh-icon.svg')}}" alt="icon" />
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-7 col-md-7">
                                                <div class="captcha-input">
                                                    <input type="text" class="form-control" placeholder="Captcha" name="captcha_code" autocomplete="off">
                                                    <input type="hidden" name="captcha" id="captcha">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="buttons">
                                            <button class="next_button">Submit</button>
                                        </div>
                                    </form>
                                    <p>
                                        <a id="forget-button">Forgot Password? (पासवर्ड भूल गए?)</a>
                                    </p>
                                    <!-- <p>                                        
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#registerModal">
                                            Don't have a UKPSC Registration? (यूकेपीएससी पंजीकरण नहीं है?)<br>
                                            Register Here! (यहां रजिस्टर करें!)
                                        </a>
                                    </p> -->
                                    
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
  <div class="modal fade" id="registerModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header align-items-start">
            <div class="d-flex align-items-center">
                <div class="img-wrap text-center">
                    <img src="{{asset('assets/images/ukpsc_logo.png')}}" width="90">
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
                <input type="hidden" name="verified">
                <div class="register-data">
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
                                    <input class="form-check-input" type="radio" name="gender" value="Male"
                                        id="male" />
                                    <label class="form-check-label" for="flexRadioDefault1">Male </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        value="Female" id="female" />
                                    <label class="form-check-label" for="flexRadioDefault1"> Female </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        value="Other" id="other" />
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
                

                    <div class="buttons mt-4">
                        <input class="next_button myBtn" type="button" id="get_OTP" value="Get OTP"/>
                    </div>
                </div>

                <div class="d-none verify-otp">

                    <div>
                        <h4 class="text-white">Verify OTP</h4>
                    </div>
                    <div class="input-div" id="otp_input">
                        <label class="form-label">OTP</label>
                        <input type="text" name="otp" id="otp">
                        <p class="text-danger" id="valid_otp"></p>
                        <div id="ten-countdown" class="text-white"></div>
                        <div class="d-none" id="resend-otp">
                            <input class="next_button resend-otp" type="button" id="resend-otp-btn" value="Resend OTP"/>
                        </div>
                    </div>

                    
                    <div class="buttons mt-4">
                        <button class="next_button" id="register-btn">Verify</button>
                    </div>
                </div>

            </form>
        </div>
      </div>
    </div>
  </div>
</body>

@include('auth.includes.footer')