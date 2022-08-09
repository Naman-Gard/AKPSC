$('#type').change((e)=>{
    if(e.target.value==='other'){
        $('#specify').parent().removeClass('d-none')
    }
    else{
        if(!$("#specify").hasClass('d-none')){
            $('#specify').parent().addClass('d-none')
        }
    }
})

$('input[name=isworking]').change((e)=>{
    if(e.target.value==='service'){
        $('#designation_row').removeClass('d-none')
    }
    else{
        if(!$('#designation_row').hasClass('d-none')){
            $('#designation_row').addClass('d-none')
            $('#designation').val('')
            $('#serving').val('')
        }
    }
})

function experienceValidation(){
    let flag=[]
    let data={
        "_token":token
    }
    
    $("#experience_fieldset .experience_input").each(function(key,value){
        if($(this).attr('id')==='specify'){
            if($('#specify').parent().hasClass('d-none')){
                flag.push(true)
            }else{
                if($('#specify').val()===''){
                    flag.push(false)
                    $('#specify').focus()
                    $('#valid_'+$(this).attr('id')).html('This field is required')
                    return false
                }
                else{
                    flag.push(true)
                    $('#valid_'+$(this).attr('id')).html('')
                }
            }
        }
        else{
            if($(this).val()===''){
                flag.push(false)
                $('#'+$(this).attr('id')).focus()
                $('#valid_'+$(this).attr('id')).html('This field is required')
                return false
            }
            else{
                $('#valid_'+$(this).attr('id')).html('')
            }
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
            url: base_url+'add/experience',
            success:function(response){

                $("#experience_fieldset .experience_input").each(function(key,value){
                    $('#'+$(this).attr('id')).val('')
                })
                if(!$("#specify").hasClass('d-none')){
                    $('#specify').parent().addClass('d-none')
                }
                let innerhtml=''
                response.forEach((item,index)=>{
                    if(item.error){
                        $('#notify-message').html('This experience type is already exist.')
                        $('#NotifyModal').modal('show')
                        // $('#experience_error').html('This experience type is already exist.')
                        return false
                    }
                    $('#notify-message').html('')
                    innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.type}</td>
                            <td>${item.year}</td>
                            <td>${item.specify}</td>
                            <td>
                                <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="experience" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg"></button>
                            </td>
                        </tr>`
                })
                if(!response[0].error){
                    $('#experience_list').html(innerhtml)
                    if(response.length){
                        experienceDataStatus=1
                    }
                    else{
                        experienceDataStatus=0
                    }
                }
            }
        })
    }
}

$('#add-experience').click(()=>{
    experienceValidation()
})

function organizationValidation(){
    let flag=[]
    let data={
        "_token":token
    }
    
    $("#experience_fieldset .org_input").each(function(key,value){
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

    if(flag.includes(false)){
        return false
    }
    else{
        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: base_url+'add/organization',
            success:function(response){

                $("#experience_fieldset .org_input").each(function(key,value){
                    $('#'+$(this).attr('id')).val('')
                })
                let innerhtml=''
                response.forEach((item,index)=>{
                    if(item.error){
                        $('#notify-message').html('This organization is already exist.')
                        $('#NotifyModal').modal('show')
                        // $('#organization_error').html('This organization is already exist.')
                        return false
                    }
                    $('#notify-message').html('')
                    innerhtml+=`<tr>
                            <th scope="row">${index+1}</th>
                            <td>${item.org_type}</td>
                            <td>${item.org_name}</td>
                            <td>${item.org_year}</td>
                            <td>
                                <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="organization" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg"></button>
                            </td>
                        </tr>`
                })
                if(!response[0].error){
                    $('#organization_list').html(innerhtml)
                    if(response.length){
                        organizationDataStatus=1
                    }
                    else{
                        organizationDataStatus=0
                    }
                }
            }
        })
    }
}

$('#add-organization').click(()=>{
    organizationValidation()
})


function isWorkingValidation(){
    let flag=[]
    let data={
        "_token":token
    }
    if($('input[name=isworking]:checked').length !== 0){
        $('#valid_isworking').html('')
        flag.push(true)
        data['isworking']=$('input[name=isworking]:checked').val()
    }
    else{
        $('#valid_isworking').html('This field is required')
        $('input[name=isworking]').focus()
        flag.push(false)
        return false
    }

    $("#experience_fieldset .serving_input").each(function(key,value){
        if(!$('#designation_row').hasClass('d-none')){
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
        }
        else{
            $('#valid_'+$(this).attr('id')).html('')
        }
        
        
    });

    if(flag.includes(false)){
        return false
    }
    else{
        return data
    }
}

function finalExperienceValidation(){
    let data=isWorkingValidation()
    if(data && experienceDataStatus && organizationDataStatus){
         $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: base_url+'add/finalExperience',
            success:function(response){

            }
         })
        return true
    }
    else{
        if(experienceDataStatus){
            // $('#experience_error').html('')
            $('#notify-message').html('')
        }
        else{
            $('#notify-message').html('Please add your Experience details')
            $('#NotifyModal').modal('show')
            return false
            // $('#experience_error').html('Please add your experience details')
        }
        if(organizationDataStatus){
            // $('#organization_error').html('')
            $('#notify-message').html('')
        }
        else{
            $('#notify-message').html('Please add organization details')
            $('#NotifyModal').modal('show')
            return false
            // $('#organization_error').html('Please add your organization details')
        }
        return false
    }
}

