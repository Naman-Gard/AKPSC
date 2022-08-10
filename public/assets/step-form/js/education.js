// $('#specialization').change((e)=>{
//     if(e.target.value===''){
//         $('#super_specialization').empty()
//         $('#super_specialization').append(`<option value="">Select</option>`)
//     }
//     else{
//         $('#super_specialization').empty()
//         $('#super_specialization').append(`<option value="">Select</option>`)
//         $('#super_specialization').append(`<option value="Chem">Chem</option>`)
//     }
// })
let qualificationDetails;
$('#degree').change((e)=>{
    $('#subject').empty()
    $('#subject').append(`<option value="">Select</option>`)
    $('#sub1').empty()
    $('#sub1').append(`<option value="">Select</option>`)
    $('#sub2').empty()
    $('#sub2').append(`<option value="">Select</option>`)
    if(e.target.value===''){
        $('#name').empty()
        $('#name').append(`<option value="">Select</option>`)
    }
    else{
        $('#name').empty()
        $('#name').append(`<option value="">Select</option>`)
        Object.keys(qualificationDetails[e.target.value]).forEach((name)=>{
            $('#name').append(`<option value="${name}">${name}</option>`)
        })
    }
})

$('#name').change((e)=>{
    if(e.target.value===''){
        $('#subject').empty()
        $('#subject').append(`<option value="">Select</option>`)
        $('#sub1').empty()
        $('#sub1').append(`<option value="">Select</option>`)
        $('#sub2').empty()
        $('#sub2').append(`<option value="">Select</option>`)
    }
    else{
        $('#subject').empty()
        $('#subject').append(`<option value="">Select</option>`)
        $('#sub1').empty()
        $('#sub1').append(`<option value="">Select</option>`)
        $('#sub2').empty()
        $('#sub2').append(`<option value="">Select</option>`)
        qualificationDetails[$('#degree').val()][e.target.value].forEach((subject)=>{
            $('#subject').append(`<option value="${subject.qual_sub}">${subject.qual_sub}</option>`)
            $('#sub1').append(`<option value="${subject.qual_sub}">${subject.qual_sub}</option>`)
            $('#sub2').append(`<option value="${subject.qual_sub}">${subject.qual_sub}</option>`)
        })
    }
})

$('#sub1').change((e)=>{
    if(e.target.value!==''){
        $('#subject option[class="d-none sub1"]').removeClass('d-none sub1')
        $('#sub2 option[class="d-none sub1"]').removeClass('d-none sub1')
        $('#subject option[value="'+e.target.value+'"]').addClass('d-none sub1')
        $('#sub2 option[value="'+e.target.value+'"]').addClass('d-none sub1')
    }
    else{
        $('#subject option[class="d-none sub1"]').removeClass('d-none sub1')
        $('#sub2 option[class="d-none sub1"]').removeClass('d-none sub1')
    }
})

$('#sub2').change((e)=>{
    if(e.target.value!==''){
        $('#subject option[class="d-none sub2"]').removeClass('d-none sub2')
        $('#sub1 option[class="d-none sub2"]').removeClass('d-none sub2')
        $('#subject option[value="'+e.target.value+'"]').addClass('d-none sub2')
        $('#sub1 option[value="'+e.target.value+'"]').addClass('d-none sub2')
    }
    else{
        $('#subject option[class="d-none sub2"]').removeClass('d-none sub2')
        $('#sub1 option[class="d-none sub2"]').removeClass('d-none sub2')
    }
})

$('#subject').change((e)=>{
    if(e.target.value!==''){
        $('#sub1 option[class="d-none subject"]').removeClass('d-none subject')
        $('#sub2 option[class="d-none subject"]').removeClass('d-none subject')
        $('#sub1 option[value="'+e.target.value+'"]').addClass('d-none subject')
        $('#sub2 option[value="'+e.target.value+'"]').addClass('d-none subject')
    }
    else{
        $('#sub1 option[class="d-none subject"]').removeClass('d-none subject')
        $('#sub2 option[class="d-none subject"]').removeClass('d-none subject')
    }
})

function educationValidation(){
    let flag=[]
    let data={
        "_token":token
    }
    $("#education_fieldset .secondList_input").each(function(key,value){
        if($(this).val()===''){
            flag.push(false)
            $('#'+$(this).attr('id')).focus()
            $('#valid_'+$(this).attr('id')).html('This field is required')
            return false
        }
        else{
            $('#valid_'+$(this).attr('id')).html('')
        }
        data[$(this).attr('id')]=$(this).val()
    });

    if($('#sub1').val()!=='' || $('#sub2').val()!=='')
    {
        if($('#subject').val()===$('#sub1').val() || $('#subject').val()===$('#sub2').val() || $('#sub1').val()===$('#sub2').val())
        {
            flag.push(false)
            $('#valid_subject').html('Please choose different Subjects')
        }
        else{
            $('#valid_subject').html('')
        }
    }
    

    if(flag.includes(false)){
        return false
    }
    else{
        data['sub1']=$('#sub1').val()
        data['sub2']=$('#sub2').val()
        
        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            // headers: {"Authorization": token},
            data:JSON.stringify(data),
            url: base_url+'add/Education',
            success:function(response){
                $("#education_fieldset .secondList_input").each(function(key,value){
                    $('#'+$(this).attr('id')).val('')
                })
                let innerhtml=''
                response.forEach((item,index)=>{
                    if(item.error){
                        // $('#education_error').html('This degree is already exist.')
                        $('#notify-message').html('This degree year is already exist.')
                        $('#NotifyModal').modal('show')
                        return false
                    }
                    $('#notify-message').html('')
                    innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.degree}</td>
                            <td>${item.name}</td>
                            <td>${item.subject}</td>
                            <td>${item.passing_year}</td>
                            <td>
                                <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="education" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg"></button>
                            </td>
                        </tr>`
                })
                if(!response[0].error){
                    $('#education_list').html(innerhtml)
                    if(response.length){
                        educationDataStatus=1
                    }
                    else{
                        educationDataStatus=0
                    }
                }
            }
        })
    }
}

$('#add-details').click(async ()=>{
    $('#education_error').html('')
    educationValidation()
})

$('#add-specialization').click(async ()=>{
    // $('#specialization_error').html('')
    specializationValidation()
})

function specializationValidation(){
    let flag=[]
    let data={
        "_token":token
    }
    
    $("#education_fieldset .firstList_input").each(function(key,value){
        if($(this).val()===''){
            flag.push(false)
            $('#'+$(this).attr('id')).focus()
            $('#valid_'+$(this).attr('id')).html('This field is required')
            return false
        }
        else{
            if($(this).val()==='Other'){
                if($('#specify_'+$(this).attr('id')+' input[type=text]').val()===''){
                    flag.push(false)
                    $('#specify_'+$(this).attr('id')).focus()
                    $('#valid_specify_'+$(this).attr('id')).html('This field is required')
                }
                else{
                    data[$(this).attr('id')]=$('#specify_'+$(this).attr('id')+' input[type=text]').val()
                    $('#specify_'+$(this).attr('id')+' input[type=text]').val('')
                    $('#valid_specify_'+$(this).attr('id')).html('')
                }
            }
            else{
                data[$(this).attr('id')]=$(this).val()
            }
            $('#valid_'+$(this).attr('id')).html('')
        }
    });

    if(flag.includes(false)){
        return false
    }
    else{
        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: base_url+'add/specialization',
            success:function(response){
                $("#education_fieldset .firstList_input").each(function(key,value){
                    $('#'+$(this).attr('id')).val('')
                })
                if(!$('#specify_specialization_subject').hasClass('d-none')){
                    $('#specify_specialization_subject').addClass('d-none')
                }
                if(!$('#specify_specialization').hasClass('d-none')){
                    $('#specify_specialization').addClass('d-none')
                }
                if(!$('#specify_super_specialization').hasClass('d-none')){
                    $('#specify_super_specialization').addClass('d-none')
                }
                let innerhtml=''
                response.forEach((item,index)=>{
                    innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.subject}</td>
                            <td>${item.specialization}</td>
                            <td>${item.super_specialization}</td>
                            <td>
                                <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="specialization" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg" ></button>
                            </td>
                        </tr>`
                })
                if(response.length){
                    SpecializationStatus=1
                }
                else{
                    SpecializationStatus=0
                }
                $('#specialization_list').html(innerhtml)
                
            }
        })
    }
}

function finalEduactionValidation(){
    if(educationDataStatus && SpecializationStatus){
        $.ajax({
            type: "GET",
            url: base_url+'final-save/education',
        })
        return true
    }
    else{
        if(SpecializationStatus){
            $('#notify-message').html('')
        }
        else{
            $('#notify-message').html('Please add your Specialization details')
            $('#NotifyModal').modal('show')
            return false
        }
        if(educationDataStatus){
            $('#notify-message').html('')
        }
        else{
            $('#notify-message').html('Please add your Qualification details')
            $('#NotifyModal').modal('show')
            return false
        }
    }
}

function getEducationDetails(){
    $.ajax({
        type: "GET",
        url: base_url+'getSubjects',
        success:function(response){
            response.forEach((subject)=>{
                $('#super_specialization').append(`<option value="${subject.subject_list}">${subject.subject_list}</option>`)
                $('#specialization').append(`<option value="${subject.subject_list}">${subject.subject_list}</option>`)
                $('#specialization_subject').append(`<option value="${subject.subject_list}">${subject.subject_list}</option>`)
            })
            $('#super_specialization').append(`<option value="Other">Other</option>`)
            $('#specialization').append(`<option value="Other">Other</option>`)
            $('#specialization_subject').append(`<option value="Other">Other</option>`)
            $('#super_specialization').append(`<option value="Not Applicable">Not Applicable</option>`)
            $('#specialization').append(`<option value="Not Applicable">Not Applicable</option>`)
            $('#specialization_subject').append(`<option value="Not Applicable">Not Applicable</option>`)
        }
    })
    $.ajax({
        type: "GET",
        url: base_url+'getQualifications',
        success:function(response){
            qualificationDetails=response
            Object.keys(response).forEach((degree)=>{
                $('#degree').append(`<option value="${degree}">${degree}</option>`)
            })
        }
    })
}

if(typeof step!=='undefined'){
    getEducationDetails()
}

$('#specialization_subject').change((e)=>{
    if(e.target.value==='Other'){
        $('#specify_specialization_subject').removeClass('d-none')
    }
    else{
        if(!$('#specify_specialization_subject').hasClass('d-none')){
            $('#specify_specialization_subject').addClass('d-none')
        }
    }
})

$('#specialization').change((e)=>{
    if(e.target.value==='Other'){
        $('#specify_specialization').removeClass('d-none')
    }
    else{
        if(!$('#specify_specialization').hasClass('d-none')){
            $('#specify_specialization').addClass('d-none')
        }
    }
})

$('#super_specialization').change((e)=>{
    if(e.target.value==='Other'){
        $('#specify_super_specialization').removeClass('d-none')
    }
    else{
        if(!$('#specify_super_specialization').hasClass('d-none')){
            $('#specify_super_specialization').addClass('d-none')
        }
    }
})