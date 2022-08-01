<fieldset id="experience_fieldset">
    <div class="form-card">
        <h2 class="fs-title">Experience</h2>
        <div class="input-div row">
            <div class="form-check col-md-6">
                <input type="radio" name="isworking" value="retired" id="retired" />
                <label class="" for="flexRadioDefault1">Retired </label>
            </div>
            <div class="form-check col-md-6">
                <input type="radio" name="isworking" value="service" id="service" />
                <label class="" for="flexRadioDefault1"> Service </label>
            </div>
            <span class="text-danger" id="valid_isworking"></span>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Designation</label>
                <select class="form-select experience_input mb-2" id="designation">
                    <option value="">Select</option>
                    <option value="Professor">Professor</option>
                    <option value="Associate Professor">Associate Professor</option>
                    <option value="Assistant Professor">Assistant Professor</option>
                </select>
                <span class="text-danger" id="valid_designation"></span>
            </div>
            <!--  -->
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Serving Under</label>
                <select class="form-select experience_input mb-2" id="serving">
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
        <div class="row">
            <h4 class="mb-4">Professional Experience</h4>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Type</label>
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
                <label for="exampleInputEmail3">Number of Years</label>
                <select class="form-select experience_input mb-2" id="year">
                    <option value="">Select</option>
                    @for($i=1 ; $i<=40 ; $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
                <span class="text-danger" id="valid_year"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group d-none">
                <label for="exampleInputEmail3">Specify</label>
                <input class="experience_input" type="text" id="specify" name="specify" placeholder="Please Specify" />
                <span class="text-danger" id="valid_specify"></span>
            </div>
        </div>
        <div class="row">
            <h4 class="mb-4">Prior Experience of acting as Advisor/Expert in Interview Board (s)/Question paper
                setter/ Objective Item writer/ Moderator/ Examiner/ Evaluator/ Syllabus Framing</h4>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Organisation Type</label>
                <select class="form-select experience_input mb-2" id="org_type">
                    <option value="">Select</option>
                    <option value="UG">UPSC</option>
                    <option value="PG">State PSC</option>
                    <option value="M Phil/PhD">State SSC</option>
                </select>
                <span class="text-danger" id="valid_org_type"></span>
            </div>
            <!--  -->
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Organisation Name</label>
                <input type="text" class="experience_input mb-2" id="org_name" name="org_name"
                    placeholder="Organisation Name" />
                <span class="text-danger" id="valid_org_name"></span>
            </div>

        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail3">Number of Years</label>
                <select class="form-select experience_input mb-2" id="org_year">
                    <option value="">Select</option>
                    @for($i=1 ; $i<=40 ; $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
                <span class="text-danger" id="valid_org_year"></span>
            </div>
        </div>
    </div>
    <!-- <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
    <input type="button" name="next" id="experience" class="next action-button" value="Save & Next" />
</fieldset>