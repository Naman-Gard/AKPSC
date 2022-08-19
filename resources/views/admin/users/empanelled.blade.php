@include('admin/includes/header')
@include('admin/includes/nav')

<div class="container mt-5 py-5">

    <div class="heading mb-3">
        <h2>Empanelled Users</h2>
    </div>
    <div class="border p-5">
        <table class="users-table table table-responsive">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Empanelled Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Subjects</th>
                    <th scope="col">Total Experience</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>


@include('admin/includes/footer')
