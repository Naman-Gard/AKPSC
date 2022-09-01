@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')

<div id="main">

    <div class="panel-sec">
        <div class="row">
            <div class="col-md-4">
                <div class="panel blue">
                    <a href="{{route('registered-users')}}">
                        <div class="panel-heading bg-blue">
                            <div class="row align-items-center">
                                <div class="col-9 col-md-9">
                                    <!-- <img src="{{ asset('assets/admin/images/user-img.png') }}" alt="icon" class="panel-icon" /> -->
                                    <div class="panel-icon">
                                        <i class="mdi mdi-account"></i>
                                    </div>
                                </div>
                                <div class="col-3 col-md-3">
                                    <span>{{$count['register']}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-footer">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Number of Expert Registered </p>
                                <img src="{{ asset('assets/admin/images/arrow_right_blue.svg') }}" alt="icon" />

                            </div>
                        </div>

                    </a>
    
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel green">
                    <a href="{{route('empanelled-users')}}">
                        <div class="panel-heading bg-green">
                            <div class="row align-items-center">
                                <div class="col-9 col-md-9">
                                    <!-- <img src="{{ asset('assets/admin/images/user-img.png') }}" alt="icon" class="panel-icon" /> -->
                                    <div class="panel-icon">
                                        <i class="mdi mdi-account-check"></i>
                                    </div>
                                </div>
                                <div class="col-3 col-md-3">
                                    <span>{{$count['empanell']}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-footer">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Number of Expert Empanelled </p>
                                <img src="{{ asset('assets/admin/images/arrow_right_green.svg') }}" />

                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel blue">
                    <a href="{{route('blacklisted-users')}}">
                        <div class="panel-heading bg-blue">
                            <div class="row align-items-center">
                                <div class="col-9 col-md-9">
                                    <!-- <img src="{{ asset('assets/admin/images/user-img.png') }}"  alt="icon" class="panel-icon" /> -->
                                    <div class="panel-icon">
                                        <i class="mdi mdi-account-off"></i>
                                    </div>
                                </div>
                                <div class="col-3 col-md-3">
                                    <span>{{$count['blacklist']}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-footer">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Number of Expert Backlisted </p>
                                <img src="{{ asset('assets/admin/images/arrow_right_blue.svg') }}" alt="icon" />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <div class="heading mb-3">
            <h2 class="heading-blue">Filters</h2>
        </div>
        <div class="border bdr-radius dashboard-tab-content p-3">
            <div class="row  mb-2">
                <div class="form-group col-md-4">
                    <label for="">Subject</label>
                    <select class="form-select" name="subject" id="subject">
                        <option value="">Select</option>
                        @foreach($subjects as $subject=>$specialization)
                        <option value="{{$subject}}">{{$subject}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Specialization</label>
                    <select class="form-select" name="subject" id="specialization">
                        <option value="">Select</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Super Specialization</label>
                    <select class="form-select" name="subject" id="super_specialization">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>            
        </div>
    </div>

    <div>
        <div class="heading mb-3">
            <h2 class="heading-blue">Experts</h2>
        </div>
        <div class="border bdr-radius dashboard-tab-content p-3">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table action-table ">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">S.no</th>
                            <th scope="col">Registration Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Subjects</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Total Experience</th>
                            <!-- <th scope="col">Super Specialization</th> -->
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_users">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

<div class="modal fade" id="EmpanelModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">

                <div class="card-header">
                    <h2>User Empanelment</h2>
                </div>
                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('add-empanel')}}" method="POST" id="add-empanel">
                            @csrf
                            
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">File Number</label>
                                    <input type="text" class="empanel_input" name="file_number" id="file_number" autocomplete='off'>
                                    <span class="text-danger" id="valid_file_number"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Date of Empanelment</label>
                                    <input type="text" class="empanel_input" name="doe" id="doe" autocomplete='off' placeholder="dd/mm/yyyy">
                                    <span class="text-danger" id="valid_doe"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Secret Code1</label>
                                    <input type="text" class="empanel_input" name="secret_code1" id="secret_code1" autocomplete='off'>
                                    <span class="text-danger" id="valid_secret_code1"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Secret Code2</label>
                                    <input type="text" class="" name="secret_code2" id="secret_code2" autocomplete='off'>
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

@include('admin/includes/footer')
