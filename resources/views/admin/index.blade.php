@include('admin/includes/header')
@include('admin/includes/nav')

<div class="container mt-5 py-5">

    <div class="panel-sec">
        <div class="row">
            <div class="col-md-4">
                <div class="panel blue">
                    <a href="">
                        <div class="panel-heading bg-blue">
                            <div class="row align-items-center">
                                <div class="col-md-9"><img src="{{ asset('assets/admin/images/user-img.png') }}" alt=""></div>
                                <div class="col-md-3">
                                    <span>{{$count['register']}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-footer">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Number of Expert Registered </p>
                                <img src="{{ asset('assets/admin/images/arrow_right_blue.svg') }}" alt="">

                            </div>
                        </div>

                    </a>
    
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel green">
                    <a href="">
                        <div class="panel-heading bg-green">
                            <div class="row align-items-center">
                                <div class="col-md-9"><img src="{{ asset('assets/admin/images/user-img.png') }}" alt=""></div>
                                <div class="col-md-3">
                                    <span>{{$count['empanell']}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-footer">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Number of Expert Empanelled </p>
                                <img src="{{ asset('assets/admin/images/arrow_right_green.svg') }}" alt="">

                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel blue">
                    <a href="">
                        <div class="panel-heading bg-blue">
                            <div class="row align-items-center">
                                <div class="col-md-9"><img src="{{ asset('assets/admin/images/user-img.png') }}" alt=""></div>
                                <div class="col-md-3">
                                    <span>{{$count['blacklist']}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-footer">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Number of Expert Backlisted </p>
                                <img src="{{ asset('assets/admin/images/arrow_right_blue.svg') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
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
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="">Specialization</label>
                <select class="form-select" name="subject" id="subject">
                    <option value="">Select</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="">Super Specialization</label>
                <select class="form-select" name="subject" id="subject">
                    <option value="">Select</option>
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
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th>{{ $loop->index+1 }}</th>
                    <td>{{$user->register_id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>
                        {{implode (", ", $user->subject)}}
                    </td>
                    <td>
                        <?php $str=''?>
                       @foreach($user->experience as $experience)
                       <?php $str.=$experience->type.':'.$experience->year.','?>
                       @endforeach
                        {{trim($str,',')}}
                    </td>
                    <!-- <td>{{implode (", ", $user->specialization)}}</td> -->
                    <!-- <td>{{implode (", ", $user->super_specialization)}}</td> -->
                    <td>
                        <button class="btn btn-sm p-2 btn-primary">Empanel</button>
                        <button class="btn btn-sm p-2 btn-primary">Blacklist</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>


@include('admin/includes/footer')
