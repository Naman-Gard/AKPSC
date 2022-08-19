@include('admin/includes/header')
@include('admin/includes/nav')

<div class="container mt-5 p-5">

    <div class="row d-flex justify-content-center mb-2">
        <section class="col-md-3 m-3 px-5 py-3 border">
            <p>Number of Expert Registered: <span>{{$count['register']}}</span> </p>
        </section>
        <section class="col-md-3 m-3 px-5 py-3 border">
            <p>Number of Expert Empanelled: <span>{{$count['empanell']}}</span></p>
        </section>
        <section class="col-md-3 m-3 px-5 py-3 border">
            <p>Number of Expert Backlisted: <span>{{$count['blacklist']}}</span></p>
        </section>
    </div>

    <div class="heading mb-3">
        <h2>Users List</h2>
    </div>
    <div class="border p-5">
        <div class="row  mb-2">
            <div class="col-md-2">
                <h3> Filters:</h3>
            </div>
            <div class="form-group col-md-3">
                <label for="">Subject</label>
                <select class="form-select" name="subject" id="subject">
                    <option value="">Select</option>
                    @foreach($subjects as $subject)
                    <option value="{{$subject->subject_list}}">{{$subject->subject_list}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="">Specialization</label>
                <select class="form-select" name="subject" id="specialization">
                    <option value="">Select</option>
                    @foreach($subjects as $subject)
                    <option value="{{$subject->subject_list}}">{{$subject->subject_list}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="">Super Specialization</label>
                <select class="form-select" name="subject" id="super_specialization">
                    <option value="">Select</option>
                    @foreach($subjects as $subject)
                    <option value="{{$subject->subject_list}}">{{$subject->subject_list}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Registration Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Total Experience</th>
                    <!-- <th scope="col">Specialization</th> -->
                    <!-- <th scope="col">Super Specialization</th> -->
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="dashboard_users">
                
            </tbody>
        </table>
    </div>
</div>
</body>

<div class="modal fade" id="EmpanelModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">


                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('add-empanel')}}" method="POST" id="add-empanel">
                            @csrf
                            <h2>User Empanelment</h2>
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="row m-2">
                                <div class="form-group col-md-6">
                                    <label for="">File Number</label>
                                    <input type="text" class="empanel_input" name="file_number" id="file_number" autocomplete='off'>
                                    <span class="text-danger" id="valid_file_number"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Date of Empanelment</label>
                                    <input type="text" class="empanel_input" name="doe" id="doe" autocomplete='off'>
                                    <span class="text-danger" id="valid_doe"></span>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="form-group col-md-6">
                                    <label for="">Secret Code1</label>
                                    <input type="text" class="empanel_input" name="secret_code1" id="secret_code1" autocomplete='off'>
                                    <span class="text-danger" id="valid_secret_code1"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Secret Code2</label>
                                    <input type="text" class="empanel_input" name="secret_code2" id="secret_code2" autocomplete='off'>
                                    <span class="text-danger" id="valid_secret_code2"></span>
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
                            <div class="row m-2">
                                <div class="form-group col-md-6">
                                    <label for="">Number of years</label>
                                    <input type="text" class="" name="lifespan" id="lifespan" autocomplete='off'>
                                    <span class="text-danger" id="valid_lifespan"></span>
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
