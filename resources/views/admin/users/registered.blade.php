@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')
<div id="main">

    <div class="heading mb-3">
        <h2 class="heading-blue">Registered Experts</h2>
    </div>
    <div class="border bdr-radius p-3">
        <div class="table-responsive">
            <table class="users-table table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">S.no</th>
                        <th scope="col">Registration Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">Father Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <!-- <th scope="col">Category</th> -->
                        <th scope="col">Subjects</th>
                        <th scope="col">Specialization</th>
                        <th scope="col">Total Experience</th>
                        <!-- <th scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                    <th>{{$loop->index+1}}</th>
                    <td><a href="{{asset('assets/uploads/cv/'.$user->cv)}}" download="{{$user->name}}">{{$user->register_id}}</a></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->father_name}}</td>
                    <td>{{$user->email}}</td>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>


@include('admin/includes/footer')
