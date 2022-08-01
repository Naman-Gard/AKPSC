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
                                    @if(session('fail'))
                                    <span class="text-danger">{{session('fail')}}</span>
                                    @endif
                                    <form method="POST" action="{{route('login')}}" id="login-form">
                                        @csrf
                                        <div class="input-div">
                                            <label for="email" class="form-label">Institute ID / Email ID (संस्थान आईडी
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
                                    <p style="font-size:14px; color:#fff; text-align:left;margin:20px 0 0 0">
                                        <a>Forgot Password? (पासवर्ड भूल गए?)</a>
                                    </p>
                                    <p style="font-size:14px; color:#fff;text-align:left; margin:20px 0 0 0">
                                        Don't have a UKPSC ID? (यूकेपीएससी आईडी नहीं है?)<br>
                                        <!-- <a id="register-here">Register Here! (यहां रजिस्टर करें!)</a> -->
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#registerModal">
                                            Register Here! (यहां रजिस्टर करें!)
                                        </a>
                                    </p>
                                    
                                </div>

                                <div class="input-text d-none" id="register">
                                    <form action="{{route('register')}}" id="register-form" method="POST">
                                        @csrf
                                        <div class="input-div">
                                            <input type="text" name="name" required autocomplete="off" />
                                            <span>Name (नाम)</span>
                                            <p class="text-danger" id="valid_name"></p>
                                        </div>
                                        <div class="input-div">
                                            <input type="text" name="father_name" required autocomplete="off" />
                                            <span>Father Name (पिता का नाम)</span>
                                            <p class="text-danger" id="valid_father_name"></p>
                                        </div>
                                        <div class="">
                                            <!-- <label>Date of Birth (जन्म की तारीख)</label> -->
                                            <input type="date" name="dob" required autocomplete="off" />
                                            <p class="text-danger" id="valid_dob"></p>
                                        </div>
                                        <div class="input-div row">
                                            <div class="form-check col-md-6">
                                                <input class="form-check-input" type="radio" name="gender" value="male"
                                                    id="male" />
                                                <label class="form-check-label" for="flexRadioDefault1">Male </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    value="female" id="female" />
                                                <label class="form-check-label" for="flexRadioDefault1"> Female </label>
                                            </div>
                                            <!-- <span>Gender (लिंग)</span> -->
                                            <p class="text-danger" id="valid_gender"></p>
                                        </div>
                                        <div class="input-div">
                                            <input type="text" name="category" required autocomplete="off" />
                                            <span>Category (श्रेणी)</span>
                                            <p class="text-danger" id="valid_category"></p>
                                        </div>
                                        <div class="input-div">
                                            <input type="text" name="mobile" required autocomplete="off" />
                                            <span>Mobile No. (मोबाइल नंबर)</span>
                                            <p class="text-danger" id="valid_mobile"></p>
                                        </div>
                                        <div class="input-div">
                                            <input type="email" name="reg_email" required autocomplete="off" />
                                            <span>Email ID (ईमेल आईडी)</span>
                                            <p class="text-danger" id="valid_email"></p>
                                        </div>
                                        <div class="input-div">
                                            <input type="password" name="pass" required autocomplete="off" />
                                            <p class="text-danger" id="valid_pass"></p>
                                            <span>Password (पासवर्ड)</span>
                                        </div>
                                        <div class="input-div">
                                            <input type="password" name="cnfrm_pass" required autocomplete="off" />
                                            <span>Confirm Password (पासवर्ड पुष्टि करें)</span>
                                        </div>
                                        <div class="buttons">
                                            <button class="next_button">Register</button>
                                        </div>
                                    </form>
                                    <p style="font-size:14px; color:#fff;text-align:left; margin:20px 0 0 0">
                                        Already have a UKPSC ID? (पहले से यूकेपीएससी आईडी है?)<br>
                                        <a id="login-here">Login Here! (यहां लॉग इन करें!)</a>
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
            <div class="img-wrap text-center">
                <img src="{{asset('assets/images/ukpsc_logo.png')}}" width="150">
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
                    <input type="date" name="dob" required autocomplete="off" />
                    <p class="text-danger" id="valid_dob"></p>
                </div>
                <div class="input-div">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="male"
                                    id="male" />
                                <label class="form-check-label" for="flexRadioDefault1">Male </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender"
                                    value="female" id="female" />
                                <label class="form-check-label" for="flexRadioDefault1"> Female </label>
                            </div>
                        </div>
                    </div>
                    <!-- <span>Gender (लिंग)</span> -->
                    <p class="text-danger" id="valid_gender"></p>
                </div>
                <div class="input-div">
                    <label for="category" class="form-label">Category (श्रेणी) <span class="red-feild">*</span></label>
                    <input type="text" name="category" required autocomplete="off" />
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
                    <button class="next_button">Register</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</body>

@include('auth.includes.footer')
<script>
    $('#register-here').click(() => {
        $('#login').addClass('d-none')
        $('#register').removeClass('d-none')
    })
    $('#login-here').click(() => {
        $('#login').removeClass('d-none')
        $('#register').addClass('d-none')
    })

    $('#login-form').on('submit', function (e) {

        e.preventDefault();
        $.each(this, function (i, element) {
            if (element.name == "password") {
                element.value = btoa(element.value);
            }
        })
        e.currentTarget.submit();

    });

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

        if ($('input[name=reg_email]').val() !== '') {
            flag.push(emailValidation())
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
            flag.push(false)
        }

        return flag.includes(false) ? false : true
    }

    $('input[name=name]').keydown((e) => {

        var keyCode = (e.keyCode ? e.keyCode : e.which);
        if (keyCode > 47 && keyCode < 58) {
            e.preventDefault();
        }
    })

    $('input[name=mobile]').keydown((e) => {
        if (e.currentTarget.value.length == 11)
            return false;
        var keyCode = (e.keyCode ? e.keyCode : e.which);
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
            $('#valid_email').html("");
            // $.ajax({
            //     type: "GET",
            //     headers: {
            //         'Access-Control-Allow-Origin': '*'
            //     },
            //     url: base_url + 'check/isEmailRegistered'-,
            // })
            return true
        } else {
            $('#valid_email').html("Please enter valid email");
            return false
        }
    }
</script>