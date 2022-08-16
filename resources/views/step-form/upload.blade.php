<fieldset id="upload_fieldset">
    <div class="form-card">
        <h2 class="fs-title">Upload Documents</h2>
        <div class="input-div row">
            <div class="form-group mb-4 col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="flexRadioDefault1">Image <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-12">
                        <div class="img-wrapper d-none">
                            <img id="image_preview" src="#" alt="" height="90" />
                        </div>
                        <input class="upload_input" type="file" name="image" id="image">
                        <p>Note: Allow only jpg,png,jpeg file</p>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                
                
            </div>
            <div class="form-group mb-4 col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="flexRadioDefault1"> Signature <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-12">
                        <div class="img-wrapper d-none">
                            <img id="sig_preview" src="#" alt="" height="90" />
                        </div>
                        <input class="upload_input" type="file" name="signature" id="signature">
                        <p>Note: Allow only jpg,png,jpeg file</p>
                        @error('signature')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="input-div row">
            <div class="form-group mb-4 col-md-6">
                <label class="upload_input" for="flexRadioDefault1">CV <span class="text-danger">*</span></label>
                <input type="file" name="cv" id="cv">
                <p>Note: Allow only pdf file</p>
                @error('cv')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
    <input type="button" name="previous" id="Preference_previous" class="previous action-button-previous" value="Previous" />
    <input type="submit" class="next action-button" value="Upload" />
</fieldset>