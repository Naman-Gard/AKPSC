@include('admin/includes/header')
@include('admin/includes/nav')

<div class="container mt-5 p-5">

    <div class="row d-flex justify-content-center mb-2">
        <section class="col-md-3 m-3 p-3 border">
            <p>Number of Expert Registered: </p><span></span>
        </section>
        <section class="col-md-3 m-3 p-3 border">
            <p>Number of Expert Empanelled: </p><span></span>
        </section>
        <section class="col-md-3 m-3 p-3 border">
            <p>Number of Expert Backlisted: </p><span></span>
        </section>
    </div>

    <!-- <div class="heading mb-3">
        <h2>Users List</h2>
    </div>
    <div class="border p-5">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Name</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->father_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->dob}}</td>
                    <td>{{$user->gender}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> -->
</div>
</body>


@include('admin/includes/footer')