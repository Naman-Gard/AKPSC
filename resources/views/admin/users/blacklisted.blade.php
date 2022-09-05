@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')
<div id="main">

    <div class="heading mb-3">
        <h2 class="heading-blue">Blacklisted Experts</h2>
    </div>
    <div class="border bdr-radius p-3">
        <div class="table-responsive">
            <table class="users-table table">
                <thead>
                    <tr>
                        <th scope="col">S.no</th>
                        <th scope="col">Empanelment Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Subjects</th>
                        <th scope="col">Specialization</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                    <th>{{$loop->index+1}}</th>
                    <td>{{$user->empanelment_id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{implode(',' , $user->subject)}}</td>
                    <td>{{implode(',' , $user->specialization)}}</td>
                    <td>{{$user->years!=='0'?'till '.$user->lifespan:$user->lifespan}}</td>
                    <td>
                        <button data-remove-link="{{route('remove-blacklistedUser',$user->user_id)}}" data-bs-toggle="modal" data-bs-target="#RemoveModal" class="btn btn-sm btn-danger p-2">Remove</button>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

<div class="modal fade" id="RemoveModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">


                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <form action=""  id="remove-court-form">
                    @csrf
                    <div class="card-body">
                        <p>Are you sure you want to remove?</p>
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm delete-mem-btn"
                            data-bs-dismiss="modal">Delete</button>
                    </div>
                </form>
                </div>



            </div>
        </div>
    </div>
</div>

@include('admin/includes/footer')

<script>

    $('#RemoveModal').on('show.bs.modal', function(e) {
        console.log($(e.relatedTarget).data('remove-link'))
        $('#remove-court-form').attr('action',$(e.relatedTarget).data('remove-link'))
    });
</script>