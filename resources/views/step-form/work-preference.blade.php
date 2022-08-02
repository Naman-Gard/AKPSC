<fieldset id="preference_fieldset">
    <div class="form-card">
        <h2 class="fs-title">Work Preference
            and Other Details
        </h2>
        <div class="form-group container border mb-3 p-3">
            <label for="exampleInputCity1">Are you willing to be appointed as</label>
            <div class="input-div row">
                <div class="col-md-8">
                    <label for="exampleInputCity1">a. Question paper setter/ Objective Item writer/ Moderator/ Examiner/
                        Evaluator/
                        Syllabus Framing</label>
                </div>

                <div class="form-check d-flex col-md-2">
                    <input type="radio" name="paper_setter" value="yes" />
                    <label class="" for="flexRadioDefault1">Yes </label>
                </div>
                <div class="form-check d-flex col-md-2">
                    <input type="radio" name="paper_setter" value="no" />
                    <label class="" for="flexRadioDefault1"> No </label>
                </div>
                <span class="text-danger" id="valid_paper_setter"></span>
            </div>
            <div class="input-div row">
                <div class="col-md-8">
                    <label for="exampleInputCity1">b. Expert in Interview Board (s)</label>
                </div>
                <div class="form-check d-flex col-md-2">
                    <input class="" type="radio" name="interview" value="yes" />
                    <label class="" for="flexRadioDefault1">Yes </label>
                </div>
                <div class="form-check d-flex col-md-2">
                    <input class="" type="radio" name="interview" value="no" />
                    <label class="" for="flexRadioDefault1"> No </label>
                </div>
                <span class="text-danger" id="valid_interview"></span>
            </div>
        </div>

        <div class="container border mb-3 p-3">
            <h4 class="mb-4">Language Proficiency</h4>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="form-check form-group d-flex col-md-4">
                        <input type="radio" name="language" value="hindi" />
                        <label>Hindi</label>
                    </div>
                    <div class="form-check form-group d-flex col-md-4">
                        <input type="radio" name="language" value="english" />
                        <label>English</label>
                    </div>
                    <div class="form-check form-group d-flex col-md-4">
                        <input type="radio" name="language" value="sanskrit" />
                        <label>Sanskrit</label>
                    </div>
                    <span class="text-danger" id="valid_language"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Proficiency Level</label>
                    <select class="form-select" name="proficiency" id="proficiency">
                        <option value="">Select</option>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Fair">Fair</option>
                    </select>
                    <span class="text-danger" id="valid_proficiency"></span>
                </div>
                <div class="mb-3">
                    <input type="button" name="add-language" id="add-language" class="action-button" value="Add" />
                </div>
            </div>
        </div>

        <div class="container border mb-3 p-3">
            <div class="row">
                <h4 class="mb-4">Address</h4>
                <div class="form-group">
                    <label for="exampleInputEmail3">Line 1</label>
                    <input type="text" class="prefrence_input mb-2" id="line_1" name="line_1" placeholder="Line 1" />
                    <span class="text-danger" id="valid_line_1"></span>
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="exampleInputEmail3">Line 2</label>
                    <input type="text" class="prefrence_input mb-2" id="line_2" name="line_2" placeholder="Line 2" />
                    <span class="text-danger" id="valid_line_2"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Pin Code</label>
                    <input type="text" class="prefrence_input mb-2" id="pin_code" name="pin_code"
                        placeholder="Pin code" />
                    <span class="text-danger" id="valid_pin_code"></span>
                </div>
            </div>
        </div>

        <div class="container border mb-3 p-3">
            <div class="input-div form-group row">
                <div class="col-md-8">
                    <label for="exampleInputCity1" class="c-text">Have you ever faced any vigilance Enquiry or were
                        debarred
                        from
                        University
                        Examination work or any Public Service Commission or Hon’ble Courts. If yes,
                        please indicate in brief</label>
                </div>
                <div class="form-check d-flex col-md-2">
                    <input type="radio" name="enquiry" value="yes" />
                    <label class="" for="flexRadioDefault1">Yes </label>
                </div>
                <div class="form-check d-flex col-md-2">
                    <input type="radio" name="enquiry" value="no" />
                    <label class="" for="flexRadioDefault1"> No </label>
                </div>
                <span class="text-danger" id="valid_enquiry"></span>
            </div>

            <div class="row">
                <div class="form-group d-none">
                    <label for="exampleInputEmail3">Brief</label>
                    <input class="prefrence_input" type="text" id="brief" name="brief" placeholder="Please Brief" />
                    <span class="text-danger" id="valid_brief"></span>
                </div>
            </div>
        </div>

    </div>
    <input type="button" name="previous" id="Experience_previous" class="previous action-button-previous"
        value="Previous" />
    <input type="button" name="next" id="work_preference" class="next action-button" value="Save & Next" />
</fieldset>