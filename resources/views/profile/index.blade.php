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
                            <th scope="col">Name</th>
                            <th scope="col">Father Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Form</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->father_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->dob}}</td>
                            <td>{{$user->gender}}</td>
                            <td>
                                <a href="{{route('form-view')}}" id="form-view" class="btn btn-sm">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <marquee> <p class="dark-green fw-100">Your form is submitted successfully</p></marquee>
            </div>
        </div>
    </div>
</section>

@include('includes/footer')
