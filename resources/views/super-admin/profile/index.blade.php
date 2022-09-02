@include('super-admin/includes/header')
@include('super-admin/includes/nav')

<div id="main">
    <div>
        <div class="heading d-flex justify-content-between">
            <h2 class="heading-blue">Profile</h2>
        </div>
        <div class="panel-sec border bdr-radius p-3">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('update-superadmin')}}" method="POST" id="profile-update">
                        <input type="hidden" name="id" value="{{Session::get('super-admin')->id}}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" required class="form-control" value="{{Session::get('super-admin')->name}}" autocomplete="off">
                                <span id="valid_name" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" required class="form-control" value="{{Session::get('super-admin')->email}}" autocomplete="off">
                                <span id="valid_email" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input type="text" name="mobile" id="mobile" required class="form-control" value="{{Session::get('super-admin')->mobile}}" autocomplete="off">
                                <span id="valid_mobile" class="text-danger"></span>
                            </div>
                        </div>
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
                            <button class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

@include('super-admin/includes/footer')
