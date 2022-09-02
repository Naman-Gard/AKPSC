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
                                <div class="input-text">
                                    @if(session('success'))
                                    <span class="text-danger" id="status">{{session('success')}}</span>
                                    @endif
                                    <form method="POST" action="{{route('superadmin-login')}}" id="login-form">
                                        @csrf
                                        <div id="login">
                                            <div class="input-div">
                                                <label for="email" class="form-label">Email ID (ईमेल आईडी)</label>
                                                <input type="email" name="email" id="email" required autocomplete="off">
                                                <!-- <span>Institute ID / Email ID (संस्थान आईडी / ईमेल आईडी)</span> -->
                                                <p class="text-danger" id="valid_email"></p>
                                            </div>
                                            <div class="input-div">
                                                <label for="email" class="form-label">Password (पासवर्ड)</label>
                                                <input type="password" name="password" id="password" required autocomplete="off">
                                                <!-- <span>Password (पासवर्ड)</span> -->
                                            </div>
                                            <div class="buttons">
                                            <button type="button" class="next_button" id="get-otp">Get OTP</button>
                                        </div>
                                        </div>

                                        <div class="d-none" id="verify-otp">
                                            <div class="input-div">
                                                <label for="otp" class="form-label">OTP</label>
                                                <input type="text" name="otp" id="otp" required autocomplete="off">
                                                <p class="text-danger" id="valid_otp"></p>
                                                <div id="ten-countdown" class="text-white"></div>
                                                <div class="d-none" id="resend-otp">
                                                    <input class="next_button resend-otp" type="button" id="resend-otp-btn" value="Resend OTP"/>
                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <button class="next_button">Submit</button>
                                            </div>
                                        </div>
                                        
                                    </form>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

</body>

@include('includes.footer')
<script src="{{ asset('assets/super-admin/js/auth.js')}}"></script>