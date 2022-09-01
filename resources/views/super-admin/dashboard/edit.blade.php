@include('super-admin/includes/header')
@include('super-admin/includes/nav')

<div id="main">

    <div>
        <div class="heading mb-3 d-flex justify-content-between">
            <h2 class="heading-blue">Edit Section</h2>
        </div>
        <div class="border bdr-radius dashboard-tab-content p-3">
            <form action="{{route('save-section')}}" method="POST" id="save-section">
                @csrf
                <input type="hidden" name="id" id="user_id" value="{{$user->id}}">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Name</label>
                        <input type="text" class="form-control edit-section-input" name="name" required id="name" value="{{$user->name}}" autocomplete='off'>
                        <span class="text-danger" id="valid_name"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Email</label>
                        <input type="email" class="form-control edit-section-input" name="email" required id="email" value="{{$user->email}}" autocomplete='off'>
                        <span class="text-danger" id="valid_email"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Mobile Number</label>
                        <input type="text" class="form-control edit-section-input" name="mobile" required id="mobile" value="{{$user->mobile}}" autocomplete='off'>
                        <span class="text-danger" id="valid_mobile"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Password</label>
                        <input type="password" class="form-control edit-section-input" name="password" id="password" autocomplete='off'>
                        <span class="text-danger" id="valid_password"></span>
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="col-md-6">
                        <button class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

@include('super-admin/includes/footer')
<script src="{{ asset('assets/super-admin/js/dashboard.js')}}"></script>