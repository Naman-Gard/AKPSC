@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')
<div id="main" class="container mt-5 p-5">

    <div class="heading mb-3">
        <h2>Empanelled Users</h2>
    </div>
    <div class="border p-5">
        <table class="users-table table table-responsive">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Empanelment Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Subjects</th>
                    <th scope="col">Total Experience</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                <th>{{$loop->index+1}}</th>
                <td>{{$user->empanelment_id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->mobile}}</td>
                <td>{{implode(',' , $user->subject)}}</td>
                <td>
                    <?php $str='';?>
                    @foreach($user->experience as $exp)
                    <?php 
                    $str.=$exp->type.':'.$exp->year.','
                    ?>
                    @endforeach
                    <?php $str=trim($str,","); ?>
                    {{$str}}
                </td>
                <td>
                    <button data-id="{{$user->user_id}}" data-bs-toggle="modal" data-bs-target="#AppointedModal" class="btn btn-sm p-2 btn-primary">Appoint</button>
                    <button data-id="{{$user->user_id}}" data-bs-toggle="modal" data-bs-target="#BlackListModal" class="btn btn-sm p-2 btn-primary">Blacklist</button>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>

<div class="modal fade" id="BlackListModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">


                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('blacklisted')}}" method="POST" id="blacklisted">
                            @csrf
                            <h2>BlackList</h2>
                            <input type="hidden" name="user_id" id="id">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <div class="form-check d-flex">
                                        <input type="radio" name="lifespan" value="years" id="years" />
                                        <label class="ms-2" for="flexRadioDefault1">Number of years </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check d-flex">
                                        <input type="radio" name="lifespan" value="lifetime" id="lifetime" />
                                        <label class="ms-2" for="flexRadioDefault1">Lifetime</label>
                                    </div>
                                </div>
                                <span class="text-danger" id="valid_lifespan"></span>
                            </div>

                            <div class="row d-none" id="n_years">
                                <div class="col-md-12 form-group">
                                    <input type="text" name="n_years" placeholder="Please enter number of years">
                                    <span id="valid_n_years" class="text-danger"></span>
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

<div class="modal fade" id="AppointedModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">


                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('appointed')}}" method="POST" id="appointed">
                            @csrf
                            <h2>Appoint User</h2>
                            <input type="hidden" name="user_id" id="appoint_user_id">

                            <div class="row m-2">
                                <div class="form-group col-md-6">
                                    <label for="">From:</label>
                                    <input type="date" max="19/08/2020" class="appoint_input" required name="from" id="from" autocomplete='off'>
                                    <span class="text-danger" id="valid_doe"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">To:</label>
                                    <input type="date" max="19/08/2020" class="appoint_input" required name="to" id="to" autocomplete='off'>
                                    <span class="text-danger" id="valid_doe"></span>
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

@include('admin/includes/footer')
