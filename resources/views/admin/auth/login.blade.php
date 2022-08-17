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
                                    <form method="POST" action="{{route('admin-login')}}" id="login-form">
                                        @csrf
                                        <div class="input-div">
                                            <label for="email" class="form-label">Email ID (ईमेल आईडी)</label>
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
</script>