@include('admin/includes/header')
@include('admin/includes/nav')
@include('admin/includes/sidebar')

<div id="main">

    <div class="mb-4">
        <div class="heading mb-3">
            <h2 class="heading-blue">Filters</h2>
        </div>
        <div class="border bdr-radius p-3">

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="">Type of Experts</label>
                    <select class="form-select report-filters" name="report_experts" id="report_experts">
                        <option value="">Registered</option>
                        <option value="Empanelled">Empanelled</option>
                        <option value="Blacklisted">Blacklisted</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Subject</label>
                    <select class="form-select report-filters" name="subject" id="report_subject">
                        <option value="">Select</option>
                        @foreach($subjects as $subject)
                        <option value="{{$subject->subject_list}}">{{$subject->subject_list}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Specialization</label>
                    <select class="form-select report-filters" name="specialization" id="report_specialization">
                        <option value="">Select</option>
                        @foreach($subjects as $subject)
                        <option value="{{$subject->subject_list}}">{{$subject->subject_list}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Super Specialization</label>
                    <select class="form-select report-filters" name="super_specialization" id="report_super_specialization">
                        <option value="">Select</option>
                        @foreach($subjects as $subject)
                        <option value="{{$subject->subject_list}}">{{$subject->subject_list}}</option>
                        @endforeach
                    </select>
                </div>               
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="">Qualification</label>
                    <select class="form-select report-filters" name="report_qual" id="report_qual">
                        <option value="">Select</option>
                        @foreach($qualification as $key=>$degree)
                        <option value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Working Status</label>
                    <select class="form-select report-filters" name="w_status" id="w_status">
                        <option value="">Select</option>
                        <option value="Retired">Retired</option>
                        <option value="Service">Service</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Designation</label>
                    <select class="form-select report-filters" name="designation" id="designation">
                        <option value="">Select</option>
                        <option value="Professor">Professor</option>
                        <option value="Associate Professor">Associate Professor</option>
                        <option value="Assistant Professor">Assistant Professor</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Number of Teaching Experience</label>
                    <select class="form-select report-filters" name="t_experience" id="t_experience">
                        <option value="">Select</option>
                        @for($i=1 ; $i<=20 ; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                                
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="">Language</label>
                    <select class="form-select report-filters" name="report_language" id="report_language">
                        <option value="">Select</option>
                        @foreach(['Hindi','English','Sanskrit'] as $subject)
                            @foreach(['Excellent','Good','Poor'] as $proficiency)
                            <option value="{{$subject}}:{{$proficiency}}">{{$subject}}:{{$proficiency}}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Gender</label>
                    <select class="form-select report-filters" name="gender" id="gender">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>                
                <div class="form-group col-md-3">
                    <label for="">Age</label>
                    <select class="form-select report-filters" name="age" id="age">
                        <option value="">Select</option>
                        @for($i=70;$i>=15;$i--)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>                                
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="">From:</label>
                    <input type="text" class="report-filters" placeholder="dd/mm/yyyy" id=report-from>
                </div>                
                <div class="form-group col-md-3">
                    <label for="">To:{!! "&nbsp;" !!}{!! "&nbsp;" !!}</label>
                    <input type="text" class="report-filters" placeholder="dd/mm/yyyy" id=report-to>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <button class="btn btn-sm p-2 btn-primary" onClick="resetFilters()">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="heading mb-3">
            <h2 class="heading-blue">Experts</h2>
        </div>
        <div class="border bdr-radius p-3">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="report-table table ">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Register Id</th>
                            <th scope="col">Empanelment Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Subjects</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Super Specialization</th>
                            <th scope="col">Qualifications</th>
                            <th scope="col">Working Status</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Serving Under</th>
                            <th scope="col">Experience</th>
                            <th scope="col">Language Proficiency</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

@include('admin/includes/footer')
<script src="{{ asset('assets/admin/js/report.js')}}"></script>
