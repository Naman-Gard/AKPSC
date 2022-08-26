@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')
<div id="main">

    <div class="heading mb-3">
        <h2 class="heading-blue">Empanelled Experts</h2>
    </div>
    <div class="border bdr-radius p-3">
        @if(session('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('success')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="table-responsive">
            <table class="users-table table ">
                <thead>
                    <tr>
                        <th scope="col">S.no</th>
                        <th scope="col">Empanelment Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Subjects</th>
                        <th scope="col">Specialization</th>
                        <th scope="col">Total Experience</th>
                        <th scope="col">Appointed Date</th>
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
                    <td>{{implode(',' , $user->specialization)}}</td>
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
                    <td id="dates-{{$user->id}}">
                        <?php $str='';?>
                        @if(sizeOf($user->appoint))
                        @foreach($user->appoint as $appoint)
                        <?php 
                        $str.='('.date("d/m/Y", strtotime($appoint->from)).'-'.date("d/m/Y", strtotime($appoint->to)).') , '
                        ?>
                        @endforeach
                        <?php $str=trim($str," , "); ?>
                        @endif
                        {{$str?$str:'Not Appointed Yet'}}
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
</div>
</body>

<div class="modal fade" id="BlackListModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">
                <div class="card-header">
                    <h2>BlackList</h2>
                </div>

                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('blacklisted')}}" method="POST" id="blacklisted">
                            @csrf
                            
                            <input type="hidden" name="user_id" id="id">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-check d-flex p-0">
                                        <input type="radio" name="lifespan" value="years" id="years" />
                                        <label class="ms-2" for="flexRadioDefault1">Number of years </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check d-flex p-0">
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

                <div class="card-header">
                    <h2>Appoint User</h2>
                </div>
                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('appointed')}}" method="POST" id="appointed">
                            @csrf
                            
                            <input type="hidden" name="user_id" id="appoint_user_id">

                            <div class="row mb-4">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from">From:</label>
                                    <input type="text" placeholder="dd/mm/yyyy" class="appoint_input date" required name="from" id="from" autocomplete='off' autofocus >
                                    <span class="text-danger" id="valid_doe"></span>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date-to">To:</label>
                                    <input type="text" placeholder="dd/mm/yyyy" class="appoint_input date" required name="to" id="to" autocomplete='off' autofocus >
                                    <span class="text-danger" id="valid_doe"></span>
                                </div>
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
