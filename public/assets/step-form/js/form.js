$(document).ready(function(){
    
    let current_fs, next_fs, previous_fs; //fieldsets
    let opacity,previous_data;
    if(typeof step!== 'undefined'){

        const step_code={
            'education':1,
            'experience':2,
            'preference':3,
            'upload':4,
        }

        $("#"+step+'_fieldset').css({
            'display': 'block',
            'position': 'relative'
        })
        for(let i=2;i<=4;i++){
            $('#step-'+i).removeClass('active')
        }

        if(step!=='education'){
            $("#education_fieldset").css({
                'display': 'none',
                'position': 'relative'
            })
            
            for(let i=1;i<=step_code[step];i++){
                if(!$('#step-'+i).hasClass('active')){
                    $('#step-'+i).addClass('active')
                }
            }
        }
    }
    
    
    $(".next").click(function(){
        let isValidated=false
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        const current_id=$(this).attr('id')

        if(current_id==='education'){
            isValidated=finalEduactionValidation()
        }
        else if(current_id==='experience'){
            isValidated=finalExperienceValidation()
        }
        else if(current_id==='work_preference'){
            isValidated=preferenceValidation()
        }

        if(isValidated){
            //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show();
        window.scrollTo(0, 0); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
        }
    });
    
    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        // const previous_id=$(this).attr('id')
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        // if(previous_id!==undefined){
        //     $.ajax({
        //         type: "GET",
        //         url: base_url+'get'+previous_id.split('_')[0]+'Data',
        //     }).done((response)=>{
        //         if(response.length){
        //             previous_data=response[0]
        //             setSaveData(previous_id.split('_')[0])
        //         }
        //     })
        // }
        
        //show the previous fieldset
        previous_fs.show();
        window.scrollTo(0, 0);
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
    
    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });
    
    $(".submit").click(function(){
        return false;
    })

    function setSaveData(step){
        console.log(previous_data)
        if(step==='Experience'){
            $('#designation option[value="'+previous_data.designation+'"]').prop("selected",true).change()
            $('#serving option[value="'+previous_data.serving+'"]').prop("selected",true).change()
            $('#type option[value="'+previous_data.type+'"]').prop("selected",true).change()
            $('#year option[value="'+previous_data.year+'"]').prop("selected",true).change()
            $('#org_type option[value="'+previous_data.org_type+'"]').prop("selected",true).change()
            $('#org_year option[value="'+previous_data.org_year+'"]').prop("selected",true).change()
            $('#org_name').val(previous_data.org_name)
            $('input[name=isworking][value="'+previous_data.isworking+'"]').attr('checked',true).change()
        }
        else{
            $('#line_1').val(previous_data.line_1)
            $('#line_2').val(previous_data.line_2)
            $('#pin_code').val(previous_data.pincode)
            // $('input[name=enquiry][value="'+previous_data.enquiry+'"]').prop('checked',true).change()
            $('input[name=enquiry]').val([previous_data.enquiry]).change()
            $('input[name=paper_setter][value="'+previous_data.paper_setter+'"]').attr('checked',true).change()
            $('input[name=interview][value="'+previous_data.interview+'"]').attr('checked',true).change()
            if(previous_data.enquiry==='yes'){
                $('#brief').parent().removeClass('d-none')
                $('#brief').val(previous_data.brief)
            }
            else{
                $('#brief').parent().addClass('d-none')
                $('#brief').val('')
            }
        }
    }

    function setFormData(){
        $.ajax({
                type: "GET",
                url: base_url+'getFormData',
                success:function(response){
                    Object.keys(response).forEach((key)=>{
                        if(key==='specialization'){
                            createSpecializationRows(response[key])
                        }
                        if(key==='education'){
                            createEducationRows(response[key])
                        }
                        if(key==='experience'){
                            createExperienceRows(response[key])
                        }
                        if(key==='organization'){
                            createOrganizationRows(response[key])
                        }
                        if(key==='isworking'){
                            if(response[key].length){
                                $('input[name=isworking][value="'+response[key][0].isworking+'"]').attr('checked',true).change()
                                // if(response[key][0].isworking==='retired'){
                                //     if(!$('#designation_row').hasClass('d-none')){
                                //         $('#designation_row').addClass('d-none')
                                //     }
                                // }
                                // else{
                                    $('#designation option[value="'+response[key][0].designation+'"]').prop("selected",true).change()
                                    $('#serving option[value="'+response[key][0].serving+'"]').prop("selected",true).change()
                                //     $('#designation_row').removeClass('d-none')
                                // }
                            }
                        }
                        if(key==='language'){
                            createLanguageRows(response[key])
                        }
                        if(key==='preference'){
                            if(response[key].length){
                                $('input[name=paper_setter][value="'+response[key][0].paper_setter+'"]').attr('checked',true).change()
                                $('input[name=interview][value="'+response[key][0].interview+'"]').attr('checked',true).change()
                                $('input[name=enquiry][value="'+response[key][0].enquiry+'"]').attr('checked',true).change()
                                if(response[key][0].enquiry ==='yes'){
                                    $('#brief').val(response[key][0].brief)
                                }
                                else{
                                    $('#brief').val('')
                                }
                                $('#line_1').val(response[key][0].line_1)
                                $('#line_2').val(response[key][0].line_2)
                                $('#pin_code').val(response[key][0].pincode)
                                $('#state option[value="'+response[key][0].state+'"]').prop("selected",true).change()
                                $('#district option[value="'+response[key][0].district+'"]').prop("selected",true).change()
                            }
                        }

                        if(key==='upload'){
                            if(response[key].length){
                                setImagesPreview(response[key][0])
                            }
                        }
                    })
                }
            })
    }

    if(window.location.pathname==='/fill-details'){
        setFormData()
    }

    let delete_id=0,heading='';
    $('.delete-mem-btn').on('click',function(){
        if(delete_id && heading!==''){
            if(heading==='specialization'){
                $.ajax({
                type: "GET",
                url: base_url+'delete/Specialization/'+btoa(delete_id),
                success:function(response){
                    createSpecializationRows(response)
                }
                })
            }

            if(heading==='education'){
                $.ajax({
                type: "GET",
                url: base_url+'delete/Education/'+btoa(delete_id),
                success:function(response){
                    createEducationRows(response)
                }
                })
            }

            if(heading==='experience'){
                $.ajax({
                type: "GET",
                url: base_url+'delete/Experience/'+btoa(delete_id),
                success:function(response){
                    createExperienceRows(response)
                }
                })
            }

            if(heading==='organization'){
                $.ajax({
                type: "GET",
                url: base_url+'delete/Organization/'+btoa(delete_id),
                success:function(response){
                    createOrganizationRows(response)
                }
                })
            }

            if(heading==='language'){
                $.ajax({
                type: "GET",
                url: base_url+'delete/Language/'+btoa(delete_id),
                success:function(response){
                    createLanguageRows(response)
                }
                })
            }
            
        }
    })

    $('#DeleteModal').on('show.bs.modal', function(e) {
        delete_id = $(e.relatedTarget).data('id');
        heading = $(e.relatedTarget).data('heading');
    });

    function createSpecializationRows(data){
        let innerhtml=''
        data.forEach((item,index)=>{
            innerhtml+=`<tr>
                    <th scope="row">${index+1}</th>
                    <td>${item.subject}</td>
                    <td>${item.specialization}</td>
                    <td>${item.super_specialization}</td>
                    <td>
                        <button type="button" class="btn btn-sm Education_delete" data-id="${item.id}" data-heading="specialization" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg" ></button>
                    </td>
                </tr>`
        })
        if(data.length){
            SpecializationStatus=1
        }
        else{
            SpecializationStatus=0
        }
        $('#specialization_list').html(innerhtml)
    }

    function createEducationRows(data){
        let innerhtml=''
        data.forEach((item,index)=>{
            innerhtml+=`<tr>
                    <th scope="row">${index+1}</th>
                    <td>${item.degree}</td>
                    <td>${item.name}</td>
                    <td>${item.subject}</td>
                    <td>${item.passing_year}</td>
                    <td>
                        <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="education" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg" ></button>
                    </td>
                </tr>`
        })
        if(data.length){
            educationDataStatus=1
        }
        else{
            educationDataStatus=0
        }
        $('#education_list').html(innerhtml)
    }

    function createExperienceRows(data){
        let innerhtml=''
        data.forEach((item,index)=>{
            innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.type}</td>
                            <td>${item.year}</td>
                            <td>${item.specify}</td>
                            <td>
                                <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="experience" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg" ></button>                           </td>
                        </tr>`
        })
        if(data.length){
            experienceDataStatus=1
        }
        else{
            experienceDataStatus=0
        }
        $('#experience_list').html(innerhtml)
    }

    function createOrganizationRows(data){
        let innerhtml=''
        data.forEach((item,index)=>{
            innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.org_type}</td>
                            <td>${item.org_name}</td>
                            <td>${item.org_year}</td>
                            <td>
                                <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="organization" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg" ></button>
                            </td>
                        </tr>`
        })
        if(data.length){
            organizationDataStatus=1
        }
        else{
            organizationDataStatus=0
        }
        $('#organization_list').html(innerhtml)
    }

    function createLanguageRows(data){
        let innerhtml=''
        data.forEach((item,index)=>{
            innerhtml+=`<tr>
                        <th scope="row">${index+1}</th>
                        <td>${item.language}</td>
                        <td>${item.proficiency}</td>
                        <td>
                            <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="language" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg"></button>
                        </td>
                    </tr>`
        })
        if(data.length){
            languageDataStatus=1
        }
        else{
            languageDataStatus=0
        }
        $('#language_list').html(innerhtml)
    }

    function setImagesPreview(data){
        $('#image_preview').parent().removeClass('d-none');
        $('#sig_preview').parent().removeClass('d-none');
        $('#image_preview').attr('src', "assets/uploads/images/"+data.image);
        $('#sig_preview').attr('src',"assets/uploads/signature/"+ data.signature);
    }
        
});