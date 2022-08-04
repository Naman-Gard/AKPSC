$('#specialization').change((e)=>{
    if(e.target.value===''){
        $('#super_specialization').empty()
        $('#super_specialization').append(`<option value="">Select</option>`)
    }
    else{
        $('#super_specialization').empty()
        $('#super_specialization').append(`<option value="">Select</option>`)
        $('#super_specialization').append(`<option value="Chem">Chem</option>`)
    }
})

$('#degree').change((e)=>{
    if(e.target.value===''){
        $('#name').empty()
        $('#name').append(`<option value="">Select</option>`)
    }
    else{
        $('#name').empty()
        $('#name').append(`<option value="">Select</option>`)
        $('#name').append(`<option value="B.Tech">B.Tech</option>`)
    }
})

$('#name').change((e)=>{
    if(e.target.value===''){
        $('#subject').empty()
        $('#subject').append(`<option value="">Select</option>`)
    }
    else{
        $('#subject').empty()
        $('#subject').append(`<option value="">Select</option>`)
        $('#subject').append(`<option value="CSE">CSE</option>`)
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
            console.log($(this).attr('id'))
            $('#'+$(this).attr('id')).focus()
            $('#valid_'+$(this).attr('id')).html('This field is required')
            return false
        }
        else{
            $('#valid_'+$(this).attr('id')).html('')
        }
        data[$(this).attr('id')]=$(this).val()
    });

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
                        $('#education_error').html('This degree is already exist.')
                        return false
                    }
                    $('#education_error').html('')
                    innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.degree}</td>
                            <td>${item.name}</td>
                            <td>${item.subject}</td>
                            <td>${item.passing_year}</td>
                            <td>
                                <input type="button" class="btn btn-danger btn-sm" data-id="${item.id}" data-heading="education" data-bs-toggle="modal" data-bs-target="#DeleteModal" value="Delete">
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
    $('#specialization_error').html('')
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
            console.log($(this).attr('id'))
            $('#'+$(this).attr('id')).focus()
            $('#valid_'+$(this).attr('id')).html('This field is required')
            return false
        }
        else{
            $('#valid_'+$(this).attr('id')).html('')
        }
        data[$(this).attr('id')]=$(this).val()
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
                let innerhtml=''
                response.forEach((item,index)=>{
                    innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.specialization}</td>
                            <td>${item.super_specialization}</td>
                            <td>
                                <input type="button" class="btn btn-danger btn-sm" data-id="${item.id}" data-heading="specialization" data-bs-toggle="modal" data-bs-target="#DeleteModal" value="Delete">
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
            $('#specialization_error').html('')
        }
        else{
            $('#specialization_error').html('Please add your specialization details')
        }
        if(educationDataStatus){
            $('#education_error').html('')
        }
        else{
            $('#education_error').html('Please add your education details')
        }
    }
}

function getSubjects(){
    $.ajax({
        type: "GET",
        url: base_url+'getSubjects',
        success:function(response){
            console.log(response)
        }
    })
}