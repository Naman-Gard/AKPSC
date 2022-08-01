<fieldset id="education_fieldset">
    <div class=" form-card">
        <h2 class="fs-title">Education Details</h2>
        <!-- use input like this -->
        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Specialization</label>
                <select class="form-select mb-2" id="specialization">
                    <option value="">Select</option>
                    <option value="math">Math</option>
                    <option value="chemistry">Chemistry</option>
                    <option value="physics">Physics</option>
                </select>
                <span class="text-danger" id="valid_specialization"></span>
            </div>
            <!--  -->
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Super Specialization</label>
                <select class="form-select mb-2" id="super_specialization">
                    <option value="">Select</option>
                </select>
                <span class="text-danger" id="valid_super_specialization"></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Deegre Type</label>
                <select class="form-select mb-2" id="degree">
                    <option value="">Select</option>
                    <option value="Graduation">Graduation</option>
                </select>
                <span class="text-danger" id="valid_degree"></span>
            </div>
            <!--  -->
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Name</label>
                <select class="form-select mb-2" id="name">
                    <option value="">Select</option>
                </select>
                <span class="text-danger" id="valid_name"></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Subject</label>
                <select class="form-select mb-2" id="subject">
                    <option value="">Select</option>
                </select>
                <span class="text-danger" id="valid_subject"></span>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Passing Year</label>
                <select class="form-select mb-2" id="passing_year">
                    <option value="">Select</option>
                    <option value="1997">1997</option>
                </select>
                <span class="text-danger" id="valid_passing_year"></span>
            </div>
        </div>



    </div>
    <div id="education_list">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Specialization</th>
                    <th scope="col">Super Specialization</th>
                    <th scope="col">Deegre Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Passing Year</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($education_details as $details)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$details->specialization}}</td>
                    <td>{{$details->super_specialization}}</td>
                    <td>{{$details->type}}</td>
                    <td>{{$details->name}}</td>
                    <td>{{$details->subject}}</td>
                    <td>{{$details->passing_year}}</td>
                    <td>
                        <input type="button" class="btn btn-danger btn-sm Education_delete" data-delete-link="{{url('delete/education/'.$details->id)}}" data-bs-toggle="modal" data-bs-target="#DeleteEducation" value="Delete">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <input type="button" name="add" id="add-details" class="action-button" value="Add" />
    <input type="button" name="next" id="education" class="next action-button" value="Save & Next" />
</fieldset>