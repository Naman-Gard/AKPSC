@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')

<div id="main">

    <div class="panel-sec border bdr-radius p-3">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('change-password')}}" method="POST" id="change-password">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                            <span id="valid_password" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" autocomplete="off">
                            <span id="valid_confirm_password" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                           <button class="btn btn-primary btn-sm">Proceed</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</body>

@include('admin/includes/footer')

<script nonce="{{Session::get('csp-code')}}">
    $('#change-password').on('submit', function (e) {

        e.preventDefault();

        let flag=passwordValidation()
        if (flag) {
            $.each(this, function (i, element) {
                if (element.name == "password") {
                    element.value = btoa(element.value);
                }
                if (element.name == "confirm_password") {
                    element.value = btoa(element.value);
                }
            })

            e.currentTarget.submit();
        }

    });

    function passwordValidation(){
        if ($('input[name=password]').val() !== '') {
            let regex=
            /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
            if($('input[name=password]').val().match(regex)){
                if ($('input[name=password]').val() === $('input[name=confirm_password]').val()) {
                    $('#valid_password').html("");
                    return true
                } else {
                    $('#valid_password').html("Password & Confirm Password doesn't match");
                    return false
                }
            }
            else{
                $('#valid_password').html("Password must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character")
                return false
            }
        }
        else{
            $('#valid_password').html("The field is required");
            return false
        }
    }
</script>