@include('includes/header')
@include('includes/nav')


<section class="profile py-5">
    <div class="container border p-5">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="heading">
                    <h2 class="dark-green">Profile</h2>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Register ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Father Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Category</th>
                            <th scope="col">Gender</th>
                            @if($user->status==='1')
                            <th scope="col">Form</th>
                            @else
                            <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($user->status==='1')
                            <td><a href="{{asset('assets/uploads/cv/'.$user->cv)}}" download="{{$user->name}}" target="_blank">{{$user->register_id}}</a></td>
                            @else
                            <td>{{$user->register_id}}</td>
                            @endif
                            <td>{{$user->name}}</td>
                            <td>{{$user->father_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->dob}}</td>
                            <td>{{$user->category}}</td>
                            <td>{{$user->gender}}</td>
                            @if($user->status==='1')
                            <td>
                                <a href="{{route('form-view')}}" id="form-view" class="btn btn-sm">View</a>
                            </td>
                            @else
                            <td>
                                <a href="{{route('fill-details')}}" id="form-view" class="btn btn-sm">Continue</a>
                            </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                @if($user->status==='1')
                <marquee> <p class="dark-green fw-100">Your online application has been submitted successfully.</p></marquee>
                @else
                <p class="text-danger fw-100">Note: Dear Applicant, Kindly complete your online application by clicking on above continue button.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@include('includes/footer')
