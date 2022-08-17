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
