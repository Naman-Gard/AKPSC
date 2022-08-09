@include('includes/header')
    <section class="preview my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="img-wrap">
                                <img src="http://localhost:8000/assets/uploads/images/1740304132855148.png" width="120" alt="">
                            </div>
                            <div class="content">
                                <h3 class="text-white mb-0 me-2">Form Preview</h3>
                            </div>
                        </div>
                    </div>
                    <div class="preview-form">
                        <div class="table-responsive">
                            <table class="table">
                                
                                <tbody>
                                    <tr>
                                        <td scope="col" colspan="2" class="text-center"><img src="{{public_path('assets/uploads/images/').$data['upload']['image']}}" width="120" height="120" alt="photo"></td>
                                        <td scope="col" class="text-center"><img src="{{public_path('assets/uploads/signature/'.$data['upload']['signature'])}}" alt="signature" width="60" height="60"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1.</th>
                                        <td>Name :</td>
                                        <td>
                                            {{$data['personal_data']['name']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2.</th>
                                        <td>
                                            Father's Name :
                                        </td>
                                        <td>
                                            {{$data['personal_data']['father_name']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3.</th>
                                        <td>
                                            Date of Birth :
                                        </td>
                                        <td>
                                            {{$data['personal_data']['dob']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4.</th>
                                        <td>
                                            Gender :
                                        </td>
                                        <td>
                                            {{$data['personal_data']['gender']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5.</th>
                                        <td>
                                            Category :
                                        </td>
                                        <td>
                                            {{$data['personal_data']['category']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6.</th>
                                        <td>
                                            Mobile Number :
                                        </td>
                                        <td>
                                            {{$data['personal_data']['mobile']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7.</th>
                                        <td>
                                            Email Id :
                                        </td>
                                        <td>
                                            {{$data['personal_data']['email']}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row" colspan="4">Education Details</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Specialization</th>
                                        <th scope="col">Super Specialization</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['education_data']['specialization'] as $key=>$specialization)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$specialization['subject']}}</td>
                                        <td>{{$specialization['specialization']}}</td>
                                        <td>{{$specialization['super_specialization']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row" colspan="5">Qualification Details</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Deegre</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Passing Year</th>
                                        <th scope="col">Subjects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['education_data']['qualifications'] as $key=>$qualifications)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$qualifications['degree']}}</td>
                                        <td>{{$qualifications['name']}}</td>
                                        <td>{{$qualifications['passing_year']}}</td>
                                        <td>{{$qualifications['subject']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                
                                <tbody>
                                    <tr>
                                        <th scope="row">13.</th>
                                        <td>
                                            Whether in serivce or retired?

                                        </td>
                                        <td>
                                            {{$data['experience_data']['isworking']['isworking']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">14.</th>
                                        <td>
                                            Designation (if Serving) :
                                        </td>
                                        <td>
                                            {{$data['experience_data']['isworking']['designation']?$data['experience_data']['isworking']['designation']:'-'}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">15.</th>
                                        <td>
                                            Serving Under :
                                        </td>
                                        <td>
                                            {{$data['experience_data']['isworking']['serving']?$data['experience_data']['isworking']['serving']:'-'}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row" colspan="4">Total Teaching/ Professional Experience</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Experience Type</th>
                                        <th scope="col">Number of Years</th>
                                        <th scope="col">Specify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['experience_data']['experience'] as $key=>$experience)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$experience['type']}}</td>
                                        <td>{{$experience['year']}}</td>
                                        <td>{{$experience['specify']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row" colspan="4">Prior Experience of acting as Advisor/Expert in
                                            Interview Board (s)/Question paper setter/ Objective Item writer/ Moderator/
                                            Examiner/ Evaluator/ Syllabus Framing Organ.</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Organisation Name</th>
                                        <th scope="col">Organisation Type</th>
                                        <th scope="col">Total Organisation Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['experience_data']['organization'] as $key=>$organization)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$organization['org_name']}}</td>
                                        <td>{{$organization['org_type']}}</td>
                                        <td>{{$organization['org_year']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="3">Are you willing to be appointed as :</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">22.</th>
                                        <td>
                                            Question paper setter/ Objective Item writer/ Moderator/ Examiner/
                                            Evaluator/ Syllabus Framing
                                        </td>
                                        <td>
                                            {{$data['preference_data']['preference']['paper_setter']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">23.</th>
                                        <td>
                                            Expert in Interview Board (s)
                                        </td>
                                        <td>
                                            {{$data['preference_data']['preference']['interview']}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row" colspan="3">Language Proficiency</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Language</th>
                                        <th scope="col">Proficiency Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['preference_data']['language'] as $key=>$language)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$language['language']}}</td>
                                        <td>{{$language['proficiency']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">23.</th>
                                        <td>
                                            Address :
                                        </td>
                                        <td>
                                            <div>{{$data['preference_data']['preference']['line_1']}}{{$data['preference_data']['preference']['line_2']}} , {{$data['preference_data']['preference']['district']}} , {{$data['preference_data']['preference']['state']}}</div>
                                            <div>Pincode: {{$data['preference_data']['preference']['pincode']}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">24.</th>
                                        <td>
                                            Have you ever faced any vigilance Enquiry or were debarred from University
                                            Examination work or any Public Service Commission or Hon’ble Courts. If yes,
                                            please indicate in brief :
                                        </td>
                                        <td>
                                            <div>{{$data['preference_data']['preference']['enquiry']}}</div>
                                            <div>{{$data['preference_data']['preference']['brief']}}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="declaration mt-4">
                            <h6 class="fw-bold">Declaration :
                            </h6>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="declaration">
                                  </div>
                                  <p>I hereby certify that the information furnished in this form is true to best of my knowledge.</p>
                            </div>
                        </div> -->
                        <!-- <div class="d-flex justify-content-end mt-3">
                            <img src="{{public_path('assets/uploads/signature/'.$data['upload']['signature'])}}" class="me-4" alt="signature" width="60" height="60">
                        </div> -->
                        <!-- <div class="btn-sec mb-5 d-flex justify-content-center mt-5">
                            <button type="submit" class="btn btn-custom mx-2" id="final-submit">Final Submit <img src="{{public_path('assets/preview/images/tick-box.gif')}}" height="24" alt=""></button>
                            <button type="submit" class="btn btn-custom mx-2" id="edit-form">Edit Form <img src="{{public_path('assets/preview/images/edit.svg')}}" height="24" alt=""></button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>
</html>
