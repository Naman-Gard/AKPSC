@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')
<div id="main">

    <div class="heading mb-3">
        <h2 class="heading-blue">Registered Users</h2>
    </div>
    <div class="border bdr-radius p-3">
        <table class="users-table table table-responsive">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Registration Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <!-- <th scope="col">Action</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                <th>{{$loop->index+1}}</th>
                <td>{{$user->register_id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->mobile}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>


@include('admin/includes/footer')
