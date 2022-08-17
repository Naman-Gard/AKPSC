<fieldset id="education_fieldset">
    <div class=" form-card">
        <h2 class="fs-title">Education Details</h2>
        <!-- use input like this -->

        <div class="container border mb-3 p-3">
            <span class="text-danger" id="specialization_error"></span>
            <div class="row">
                <div class="col-md-11">
                    <div class="form-sec">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Subject <span class="text-danger">*</span></label>
                                    <select class="form-select mb-2 firstList_input" id="specialization_subject">
                                        <option value="">Select</option>
                                    </select>
                                    <span class="text-danger" id="valid_specialization_subject"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Specialization <span class="text-danger">*</span></label>
                                    <select class="form-select mb-2 firstList_input" id="specialization">
                                        <option value="">Select</option>
                                    </select>
                                    <span class="text-danger" id="valid_specialization"></span>
                                </div>
            
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Super Specialization <span class="text-danger">*</span></label>
                                    <select class="form-select mb-2 firstList_input" id="super_specialization">
                                        <option value="">Select</option>
                                    </select>
                                    <span class="text-danger" id="valid_super_specialization"></span>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="custom-add">
                        <input type="button" name="add-specialization" id="add-specialization" class="action-button" value="Add" />
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="form-group col-md-4 d-none" id="specify_specialization_subject">
                    <input type="text" placeholder="Please specify your Subject">
                    <p class="mb-3 note-txt2 text-danger">Note:Please specify complete name of Subject</p>
                    <span class="text-danger" id="valid_specify_specialization_subject"></span>
                </div>

                <div class="form-group col-md-4 d-none" id="specify_specialization">
                    <input type="text" placeholder="Please specify your Specialization">
                    <p class="mb-3 note-txt2 text-danger">Note:Please specify complete name of Specialization</p>
                    <span class="text-danger" id="valid_specify_specialization"></span>
                </div>

                <div class="form-group col-md-4 d-none" id="specify_super_specialization">
                    <input type="text" placeholder="Please specify your Super Specialization">
                    <p class="mb-3 note-txt2 text-danger">Note:Please specify complete name of Super Specialization</p>
                    <span class="text-danger" id="valid_specify_super_specialization"></span>
                </div>
            </div>

            

            <div>
                <table class="table step-table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">S.no</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Super Specialization</th>
                            <th scope="col" width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="specialization_list">
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="container border p-3">
            <h4 class="mb-2">Qualification Details</h4>
            <span class="text-danger" id="education_error"></span>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Degree Type <span class="text-danger">*</span></label>
                    <select class="form-select mb-2 secondList_input" id="degree">
                        <option value="">Select</option>
                    </select>
                    <span class="text-danger" id="valid_degree"></span>
                </div>
                <!--  -->
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Degree Name <span class="text-danger">*</span></label>
                    <select class="form-select mb-2 secondList_input" id="name">
                        <option value="">Select</option>
                    </select>
                    <span class="text-danger" id="valid_name"></span>
                </div>
            </div>

            <div class="row">
                
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Passing Year <span class="text-danger">*</span></label>
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
                    <label for="exampleInputEmail3">Subject <span class="text-danger">*</span></label>
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
                <table class="table step-table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">S.no</th>
                            <!-- <th scope="col">Specialization</th>
                            <th scope="col">Super Specialization</th> -->
                            <th scope="col">Degree Type</th>
                            <th scope="col">Degree Name</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Passing Year</th>
                            <th scope="col" width="5%">Action</th>
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