<fieldset id="upload_fieldset">
    <div class="form-card">
        <h2 class="fs-title">Upload Documents</h2>
        <div class="input-div row">
            <div class="form-group col-md-6">
                <label for="flexRadioDefault1">Image </label>
                <input class="upload_input" type="file" name="image" id="image">
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="flexRadioDefault1"> Signature </label>
                <input class="upload_input" type="file" name="signature" id="signature">
                @error('signature')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="input-div row">
            <div class="form-group col-md-6">
                <label class="upload_input" for="flexRadioDefault1">CV</label>
                <input type="file" name="cv" id="cv">
                @error('cv')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
    <input type="button" name="previous" id="Preference_previous" class="previous action-button-previous" value="Previous" />
    <input type="submit" class="next action-button" value="Upload" />
</fieldset>