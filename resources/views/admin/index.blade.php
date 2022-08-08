@include('admin/includes/header')
@include('admin/includes/nav')

<div class="container mt-5 p-5">
    <div>
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
    </div>
</div>
</body>


@include('admin/includes/footer')