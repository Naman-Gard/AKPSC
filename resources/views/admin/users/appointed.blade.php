@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')
<div id="main">

    <div class="heading mb-3">
        <h2 class="heading-blue">Appointed Experts</h2>
    </div>
    <div class="border bdr-radius p-3">
        <div class="table-responsive">
            <table class="users-table table table-responsive">
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
                    <td>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

@include('admin/includes/footer')
