@include('auth.includes.header')

<div class="container mt-5 mb-5">
    <?php $email=base64_encode($email);$date=base64_encode($date);$time=base64_encode($time)?>
    <form class="pt-3" action="{{route('succeed',[$email,$date,$time])}}" method="POST">
        @csrf
        <div class="img-wrap text-center mb-4">
            <img src="{{asset('assets/images/ukpsc_logo.png')}}" width="150">
        </div>
        <div class="form-group mb-4">
        <input type="password" name="password" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Password" autocomplete="off">
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group mb-4">
        <input type="password" name="password_confirmation" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Confirm Password" autocomplete="off">
        @error('password_confirmation')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" style="display:block;" value="Reset Password"/>  
        </div>
    </form>
</div>