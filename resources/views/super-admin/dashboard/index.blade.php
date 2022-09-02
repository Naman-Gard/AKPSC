@include('super-admin/includes/header')
@include('super-admin/includes/nav')

<div id="main">

    <div>
        <div class="heading mb-3 d-flex justify-content-between">
            <h2 class="heading-blue">Sections</h2>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddUserModal">Add</button>
        </div>
        <div class="border bdr-radius dashboard-tab-content p-3">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">S.no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th>{{$loop->index+1}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>
                                <?php $id=encode5t($user->id)?>
                                <a href="{{route('edit-section',$id)}}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{route('remove-section',$id)}}" class="btn btn-sm btn-danger">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

<div class="modal fade" id="AddUserModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">

                <div class="card-header">
                    <h2>Add Section</h2>
                </div>
                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('add-section')}}" method="POST" id="add-section">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Name</label>
                                    <input type="text" class="add-section-input" name="name" required id="name" autocomplete='off'>
                                    <span class="text-danger" id="valid_name"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Email</label>
                                    <input type="email" class="add-section-input" name="email" required id="email" autocomplete='off'>
                                    <span class="text-danger" id="valid_email"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Mobile Number</label>
                                    <input type="text" class="add-section-input" name="mobile" required id="mobile" autocomplete='off'>
                                    <span class="text-danger" id="valid_mobile"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Password</label>
                                    <input type="password" class="add-section-input" name="password" required id="password" autocomplete='off'>
                                    <span class="text-danger" id="valid_password"></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm">Add</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('super-admin/includes/footer')
