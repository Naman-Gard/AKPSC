@include('includes/header')
@include('includes/nav')

    <section class="heading mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div class="btn-sec d-flex justify-content-end pb-4">
                    <a href="{{route('generate-pdf')}}" target="_blank" class="btn download-btn btn-custom">Download <img src="{{asset('assets/images/download.svg')}}"></a>
                </div>
                </div>
            </div>
        </div>
    </section>

    

    <section class="preview">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="heading">
                        <div class="d-flex align-items-center">
                            <div class="img-wrap">
                                <img src="{{asset('assets/preview/images/ukpsc_logo.png')}}" width="120" alt="">
                            </div>
                            <div class="content text-center">
                                <h2 class="text-white me-2 fw-bold">
                                UTTARAKHAND PUBLIC SERVICE COMMISSION HARIDWAR 
                                </h2>
                                <h5 class="text-white mb-0 fw-bold">ONLINE FORMAT FOR BIO-DATA OF EXPERTS</h5>
                            </div>
                        </div>
                    </div>
                    <div class="preview-form">
                        <div class="table-responsive">
                            <table class="table">
                                
                                <tbody>
                                    <tr>
                                        <th>Name :</th>
                                        <td>
                                            {{$data['personal_data']['name']}}
                                        </td>
                                        <td rowspan="7">
                                            <div class="img-wrap text-center d-flex flex-column">
                                                <div class="img1 mb-4">
                                                    <img src="{{asset('assets/uploads/images/'.$data['upload']['image'])}}" width="140" height="140" alt="photo">
                                                </div>
                                                <div class="img2">
                                                    <img src="{{asset('assets/uploads/signature/'.$data['upload']['signature'])}}" alt="signature" width="100" height="60">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Father's Name :
                                        </th>
                                        <td>
                                            {{$data['personal_data']['father_name']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Date of Birth :
                                        </th>
                                        <td>
                                            {{$data['personal_data']['dob']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Gender :
                                        </th>
                                        <td>
                                            {{$data['personal_data']['gender']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Category :
                                        </th>
                                        <td>
                                            {{$data['personal_data']['category']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Mobile Number :
                                        </th>
                                        <td>
                                            {{$data['personal_data']['mobile']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Email Id :
                                        </th>
                                        <td>
                                            {{$data['personal_data']['email']}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="dark-green" scope="row" colspan="3">Education Details</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Specialization</th>
                                        <th scope="col">Super Specialization</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['education_data']['specialization'] as $key=>$specialization)
                                    <tr>
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
                                        <th class="dark-green" scope="row" colspan="4">Qualification Details</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Deegre</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Passing Year</th>
                                        <th scope="col">Subjects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['education_data']['qualifications'] as $key=>$qualifications)
                                    <tr>
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
                                        <th class="w-50">
                                            Whether in serivce or retired?

                                        </th>
                                        <td class="w-50">
                                            {{$data['experience_data']['isworking']['isworking']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Designation (if Serving) :
                                        </th>
                                        <td>
                                            {{$data['experience_data']['isworking']['designation']?$data['experience_data']['isworking']['designation']:'-'}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Serving Under :
                                        </th>
                                        <td>
                                            {{$data['experience_data']['isworking']['serving']?$data['experience_data']['isworking']['serving']:'-'}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row" class="dark-green"  colspan="3">Total Teaching/ Professional Experience</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Experience Type</th>
                                        <th scope="col">Number of Years</th>
                                        <th scope="col">Specify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['experience_data']['experience'] as $key=>$experience)
                                    <tr>
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
                                        <th class="dark-green" scope="row" colspan="3">Prior Experience of acting as Advisor/Expert in
                                            Interview Board (s)/Question paper setter/ Objective Item writer/ Moderator/
                                            Examiner/ Evaluator/ Syllabus Framing Organ.</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Organisation Name</th>
                                        <th scope="col">Organisation Type</th>
                                        <th scope="col">Total Organisation Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['experience_data']['organization'] as $key=>$organization)
                                    <tr>
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
                                        <th colspan="2">Are you willing to be appointed as :</th>
                                    </tr>
                                    <tr>
                                        <th class="w-75">
                                            Question paper setter/ Objective Item writer/ Moderator/ Examiner/
                                            Evaluator/ Syllabus Framing
                                        </th>
                                        <td class="w-25">
                                            {{$data['preference_data']['preference']['paper_setter']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Expert in Interview Board (s)
                                        </th>
                                        <td>
                                            {{$data['preference_data']['preference']['interview']}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="dark-green" scope="row" colspan="2">Language Proficiency</th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="w-50">Language</th>
                                        <th scope="col"  class="w-50">Proficiency Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['preference_data']['language'] as $key=>$language)
                                    <tr>
                                        <td class="w-50">{{$language['language']}}</td>
                                        <td>{{$language['proficiency']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th  class="w-50">
                                            Address :
                                        </th>
                                        <td  class="w-50">
                                            <div>{{$data['preference_data']['preference']['line_1']}}{{$data['preference_data']['preference']['line_2']}} , {{$data['preference_data']['preference']['district']}} , {{$data['preference_data']['preference']['state']}}</div>
                                            <div>Pincode: {{$data['preference_data']['preference']['pincode']}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Have you ever faced any vigilance Enquiry or were debarred from University
                                            Examination work or any Public Service Commission or Hon’ble Courts. If yes,
                                            please indicate in brief :
                                        </th>
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
                            <img src="{{asset('assets/uploads/signature/'.$data['upload']['signature'])}}" class="me-4" alt="signature" width="60" height="60">
                        </div> -->
                        <!-- <div class="btn-sec mb-5 d-flex justify-content-center mt-5">
                            <button type="submit" class="btn btn-custom mx-2" id="final-submit">Final Submit <img src="{{asset('assets/preview/images/tick-box.gif')}}" height="24" alt=""></button>
                            <button type="submit" class="btn btn-custom mx-2" id="edit-form">Edit Form <img src="{{asset('assets/preview/images/edit.svg')}}" height="24" alt=""></button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>
</html>

@include('includes/footer')
