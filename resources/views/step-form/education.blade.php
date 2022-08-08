<fieldset id="education_fieldset">
    <div class=" form-card">
        <h2 class="fs-title">Education Details</h2>
        <!-- use input like this -->

        <div class="container border mb-3 p-3">
            <span class="text-danger" id="specialization_error"></span>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Subject</label>
                        <select class="form-select mb-2 firstList_input" id="specialization_subject">
                            <option value="">Select</option>
                        </select>
                        <span class="text-danger" id="valid_specialization_subject"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Specialization</label>
                        <select class="form-select mb-2 firstList_input" id="specialization">
                            <option value="">Select</option>
                        </select>
                        <span class="text-danger" id="valid_specialization"></span>
                    </div>
                </div>
                
                <!--  -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Super Specialization</label>
                        <select class="form-select mb-2 firstList_input" id="super_specialization">
                            <option value="">Select</option>
                        </select>
                        <span class="text-danger" id="valid_super_specialization"></span>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <input type="button" name="add-specialization" id="add-specialization" class="action-button" value="Add" />
            </div>

            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Super Specialization</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="specialization_list">
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="container border p-3">
            <h4 class="mb-4">Qualification Details</h4>
            <span class="text-danger" id="education_error"></span>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Deegre</label>
                    <select class="form-select mb-2 secondList_input" id="degree">
                        <option value="">Select</option>
                    </select>
                    <span class="text-danger" id="valid_degree"></span>
                </div>
                <!--  -->
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Name</label>
                    <select class="form-select mb-2 secondList_input" id="name">
                        <option value="">Select</option>
                    </select>
                    <span class="text-danger" id="valid_name"></span>
                </div>
            </div>

            <div class="row">
                
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Passing Year</label>
                    <select class="form-select mb-2 secondList_input" id="passing_year">
                        <option value="">Select</option>
                        @for($i=67;$i<=99;$i++)
                        <option value="19{{$i}}">19{{$i}}</option>
                        @endfor
                        <option value="2000">2000</option>
                        @for($i=01;$i<=9;$i++)
                        <option value="200{{$i}}">200{{$i}}</option>
                        @endfor
                        @for($i=10;$i<=22;$i++)
                        <option value="20{{$i}}">20{{$i}}</option>
                        @endfor
                    </select>
                    <span class="text-danger" id="valid_passing_year"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Subject</label>
                    <select class="form-select mb-2 secondList_input" id="subject">
                        <option value="">Select</option>
                    </select>
                    <span class="text-danger" id="valid_subject"></span>
                </div>
            </div>

             <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Subject (Optional)</label>
                    <select class="form-select mb-2" id="sub1">
                        <option value="">Select</option>
                    </select>
                    <span class="text-danger" id="valid_sub1"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Subject (Optional)</label>
                    <select class="form-select mb-2" id="sub2">
                        <option value="">Select</option>
                    </select>
                    <span class="text-danger" id="valid_sub2"></span>
                </div>
            </div>

            <div class="mb-3">
                <input type="button" name="add" id="add-details" class="action-button" value="Add" />
            </div>

            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <!-- <th scope="col">Specialization</th>
                            <th scope="col">Super Specialization</th> -->
                            <th scope="col">Deegre Name</th>
                            <th scope="col">Name</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Passing Year</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="education_list">
                    </tbody>
                </table>
            </div>
        </div>
        



    </div>
    <input type="button" name="next" id="education" class="next action-button" value="Save & Next" />
</fieldset>