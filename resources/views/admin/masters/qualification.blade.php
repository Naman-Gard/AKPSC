@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')
<div id="main">

    <div class="heading mb-3">
        <h2 class="heading-blue">Qualifications</h2>
    </div>
    <div class="border bdr-radius p-3">
        @if(session('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('success')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('error')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row pb-3">
            <div class="col-md-4">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddDegreeType">Add New Degree Types</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddDegreeName">Add New Degree Names</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddSubject">Add Subjects</button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="masters-table table">
                <thead>
                    <tr>
                        <th scope="col">S.no</th>
                        <th scope="col">Degree Type</th>
                        <th scope="col">Degree Name</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($qualifications as $qualification)
                    <tr>
                        <th>{{$loop->index+1}}</th>
                        <td>{{$qualification->qual_name}}</td>
                        <td>{{$qualification->qual_deg}}</td>
                        <td>{{$qualification->qual_sub}}</td>
                        <td>
                            <?php $uniqueid=base64_encode($qualification->id) ?>
                            <button data-remove-link="{{route('deleteQualification',$uniqueid)}}" data-bs-toggle="modal" data-bs-target="#RemoveModal" class="btn btn-sm p-2 m-1 btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

<div class="modal fade" id="AddDegreeType">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">

                <div class="card-header">
                    <h2>Add Degree Types</h2>
                </div>
                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('addDegreeType')}}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Degree Types</label>
                                    <input type="text" placeholder="Add mutiple degree types by using ' || ' seperator" class="" name="degree_type" required id="degree_type" autocomplete='off'>
                                    <span class="text-danger" id="degree_type"></span>
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

<div class="modal fade" id="AddDegreeName">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">

                <div class="card-header">
                    <h2>Add Degree Name</h2>
                </div>
                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('addDegreeName')}}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Degree Type</label>
                                    <select required class="form-select report-filters" name="degree_type" id="degree_type">
                                        <option value="">Select</option>
                                        @foreach($degreeTypes as $degree)
                                        <option value="{{$degree->qual_name}}">{{$degree->qual_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="degree_type"></span>
                                </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Add mutiple degree names by using ' || ' seperator" class="" name="degree_name" required id="degree_name" autocomplete='off'>
                                    <span class="text-danger" id="degree_name"></span>
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

<div class="modal fade" id="AddSubject">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">

                <div class="card-header">
                    <h2>Add Subject</h2>
                </div>
                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <form action="{{route('addSubject')}}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Degree Type</label>
                                    <select required class="form-select report-filters" name="degree_type" id="degree_type_sub">
                                        <option value="">Select</option>
                                        @foreach($degreeTypes as $degree)
                                        <option value="{{$degree->qual_name}}">{{$degree->qual_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="degree_type"></span>
                                </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Degree Name</label>
                                    <select required class="form-select report-filters" name="degree_name" id="degree_name_sub">
                                        <option value="">Select</option>
                                        
                                    </select>
                                    <span class="text-danger" id="degree_name"></span>
                                </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Add mutiple subjects by using ' || ' seperator" class="" name="subject" required id="subject" autocomplete='off'>
                                    <span class="text-danger" id="subject"></span>
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
<script nonce="{{Session::get('csp-code')}}">
    let qualSubjects;
    $('#RemoveModal').on('show.bs.modal', function(e) {
        $('#remove-court-form').attr('action',$(e.relatedTarget).data('remove-link'))
    });

    $('document').ready(()=>{
        $.ajax({
            type: "GET",
            url: base_url + 'secureadmin/getQualificationsubject',
            success: function (response) {
                qualSubjects=response
            }
        })
    })

    $('#degree_type_sub').change((e)=>{
        $('#degree_name_sub').empty()
        $('#degree_name_sub').append(`<option value="">Select</option>`)
        qualSubjects[e.target.value].forEach((deg_name)=>{
            $('#degree_name_sub').append(`<option value="${deg_name.qual_deg}">${deg_name.qual_deg}</option>`)
        })
    })
</script>