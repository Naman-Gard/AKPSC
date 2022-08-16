<fieldset id="experience_fieldset">
    <div class="form-card">
        <h2 class="fs-title">Experience</h2>

        <div class="container border mb-3 p-3">

            <div class="input-div">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="exampleInputCity1" class="c-text">Whether in serivce or retired? <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check d-flex">
                            <input type="radio" name="isworking" value="retired" id="retired" />
                            <label class="ms-2" for="flexRadioDefault1">Retired </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check d-flex">
                            <input type="radio" name="isworking" value="service" id="service" />
                            <label class="ms-2" for="flexRadioDefault1"> Service </label>
                        </div>
                    </div>
                    <span class="text-danger" id="valid_isworking"></span>
                </div>
            </div>

            <div class="row mt-2 d-none" id="designation_row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Designation <span class="text-danger">*</span></label>
                    <select class="form-select serving_input mb-2" id="designation">
                        <option value="">Select</option>
                        <option value="Professor">Professor</option>
                        <option value="Associate Professor">Associate Professor</option>
                        <option value="Assistant Professor">Assistant Professor</option>
                    </select>
                    <span class="text-danger" id="valid_designation"></span>
                </div>
                <!--  -->
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Serving Under <span class="text-danger">*</span></label>
                    <select class="form-select serving_input mb-2" id="serving">
                        <option value="">Select</option>
                        <option value="Central Govt">Central Govt</option>
                        <option value="State Government">State Government</option>
                        <option value="Autonomous Organization">Autonomous Organization</option>
                        <option value="Private Organisation">Private Organisation</option>
                        <option value="State Government Undertaking">State Government Undertaking</option>
                        <option value="Central Government Undertaking">Central Government Undertaking</option>
                    </select>
                    <span class="text-danger" id="valid_serving"></span>
                </div>
            </div>

        </div>

        <div class="container border mb-3 p-3">

            <div class="row">
                <h4 class="mb-2">Professional Experience</h4>
                <!-- <span class="text-danger mb-3" id="experience_error"></span> -->
                <div class="col-md-11">
                    <div class="form-sec">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail3">Type <span class="text-danger">*</span></label>
                                <select class="form-select experience_input mb-2" id="type">
                                    <option value="">Select</option>
                                    <option value="UG">UG</option>
                                    <option value="PG">PG</option>
                                    <option value="M Phil/PhD">M Phil/PhD</option>
                                    <option value="other">Any other</option>
                                </select>
                                <span class="text-danger" id="valid_type"></span>
                            </div>
                            <!--  -->
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail3">Number of Years <span class="text-danger">*</span></label>
                                <select class="form-select experience_input mb-2" id="year">
                                    <option value="">Select</option>
                                    @for($i=1 ; $i<=40 ; $i++) <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                                <span class="text-danger" id="valid_year"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="custom-add mt-1">
                        <input type="button" name="add-experience" id="add-experience" class="action-button" value="Add" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group d-none">
                    <label for="exampleInputEmail3">Specify <span class="text-danger">*</span></label>
                    <input class="experience_input" type="text" id="specify" name="specify"
                        placeholder="Please Specify" />
                    <span class="text-danger" id="valid_specify"></span>
                </div>
            </div>

            

            <div class="table-responsive mt-3">
                <table class="table step-table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">S.no</th>
                            <th scope="col">Experience Type</th>
                            <th scope="col">Number of Years</th>
                            <th scope="col">Specify</th>
                            <th scope="col" width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="experience_list">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container border mb-3 p-3">
            <div class="row">
                <h4 class="mb-3">
                    Prior Experience of acting as Advisor/Expert in Interview Board (s)/Question paper setter/ Objective Item writer/ Moderator/ Examiner/ Evaluator/ Syllabus Framing
                </h4>
                <!-- <span class="text-danger mb-3" id="organization_error"></span> -->
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Organisation Type <span class="text-danger">*</span></label>
                    <select class="form-select org_input mb-2" id="org_type">
                        <option value="">Select</option>
                        <option value="UPSC">UPSC</option>
                        <option value="State PSC">State PSC</option>
                        <option value="State SSC">State SSC</option>
                    </select>
                    <span class="text-danger" id="valid_org_type"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Organisation Name <span class="text-danger">*</span></label>
                    <input type="text" autocomplete="off" class="org_input mb-2" id="org_name" name="org_name"
                        placeholder="Organisation Name" />
                    <span class="text-danger" id="valid_org_name"></span>
                </div>

            </div>
            <div class="row mt-3">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Number of Years <span class="text-danger">*</span></label>
                    <select class="form-select org_input mb-2" id="org_year">
                        <option value="">Select</option>
                        @for($i=1 ; $i<=40 ; $i++) <option value="{{$i}}">{{$i}}</option>
                            @endfor
                    </select>
                    <span class="text-danger" id="valid_org_year"></span>
                </div>
            </div>

            <div class="mb-3">
                <input type="button" name="add-organization" id="add-organization" class="action-button" value="Add" />
            </div>

            <div class="table-responsive">
                <table class="table step-table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">S.no</th>
                            <th scope="col">Organization Type</th>
                            <th scope="col">Organization Name</th>
                            <th scope="col">Number of Years</th>
                            <th scope="col" width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="organization_list">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
    <input type="button" name="next" id="experience" class="next action-button" value="Save & Next" />
</fieldset>