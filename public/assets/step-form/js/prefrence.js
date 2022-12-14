$('input[name=enquiry]').change((e)=>{
    if(e.target.value==='Yes'){
        $('#brief').parent().removeClass('d-none')
    }
    else{
        $('#brief').parent().addClass('d-none')
        $('#brief').val('')
    }
})

$('#state').change((e)=>{
    $('#district').find('option').not(':first').remove()
    if(e.target.value!==''){
        states[e.target.value].sort((a,b) => a.district_name.localeCompare(b.district_name));
        states[e.target.value].forEach((district)=>{
            $('#district').append(`<option value="${district.district_name}">${district.district_name}</option>`)
        })
    }
})

$('#language').change((e)=>{
    $('.specify_language').val('')
    if(e.target.value==='Other'){
        $('#specify_language').removeClass('d-none')
    }
    else{
        if(!$('#specify_language').hasClass('d-none')){
            $('#specify_language').addClass('d-none')
        }
    }
})

$('input[name=pin_code]').keydown((e) => {
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (e.currentTarget.value.length == 6 && keyCode!==8)
        return false;
    
    return e.ctrlKey || e.altKey 
                || (47<e.keyCode && e.keyCode<58 && e.shiftKey==false) 
                || (95<e.keyCode && e.keyCode<106)
                || (e.keyCode==8) || (e.keyCode==9) 
                || (e.keyCode>34 && e.keyCode<40) 
                || (e.keyCode==46)
})

function languageValidation(){
    let data={
        "_token":token
    }
    if($('#language').val() === ''){
        $('#valid_language').html('This field is required')
        $('#language').focus()
        return false
        
    }
    else if($('#language').val() === 'Other'){
        if($('.specify_language').val()===''){
            $('.specify_language').focus()
            $('#valid_specify_language').html('This field is required')
            return false
        }
        else{
            data['language']=$('.specify_language').val()
            $('#valid_specify_language').html('')
        }
    }
    else{
        $('#valid_language').html('')
        data['language']=$('#language').val()
    }

    if($('#proficiency').val()!==''){
        $('#valid_proficiency').html('')
        data['proficiency']=$('#proficiency').val()
    }
    else{
        $('#proficiency').focus()
        $('#valid_proficiency').html('This field is required')
        return false
    }

    $.ajax({
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        data:JSON.stringify(data),
        url: base_url+'add/LanguageDetails',
        success:function(response){
            $('#language').val('')
            $('#proficiency').val('')
            $('.specify_language').val('')
            if(!$('#specify_language').hasClass('d-none')){
                $('#specify_language').addClass('d-none')
            }
            let innerhtml=''
            response.forEach((item,index)=>{
                if(item.error){
                    // $('#language_error').html('This language proficiency is already exist.')
                    $('#notify-message').html('This language proficiency is already exist.')
                    $('#NotifyModal').modal('show')
                    return false
                }
                // $('#language_error').html('')
                $('#notify-message').html('')
                innerhtml+=`<tr>
                        <th scope="row">${index+1}</th>
                        <td>${item.language}</td>
                        <td>${item.proficiency}</td>
                        <td>
                            <button type="button" class="btn btn-sm" data-id="${item.id}" data-heading="language" data-bs-toggle="modal" data-bs-target="#DeleteModal"><img src="${base_url}assets/images/delete.svg"></button>
                        </td>
                    </tr>`
            })
            if(!response[0].error){
                $('#language_list').html(innerhtml)
                if(response.length){
                    languageDataStatus=1
                }
                else{
                    languageDataStatus=0
                }
            }
        }
    })
}

$('#add-language').click(()=>{
    languageValidation()
})

function preferenceValidation(){
    let flag=[]
    let data={
        "_token":token
    }

    if($('input[name=paper_setter]:checked').length !== 0){
        $('#valid_paper_setter').html('')
        flag.push(true)
        data['paper_setter']=$('input[name=paper_setter]:checked').val()
    }
    else{
        $('#valid_paper_setter').html('This field is required')
        $('input[name=paper_setter]').focus()
        flag.push(false)
        return false
    }

    if($('input[name=interview]:checked').length !== 0){
        $('#valid_interview').html('')
        flag.push(true)
        data['interview']=$('input[name=interview]:checked').val()
    }
    else{
        $('#valid_interview').html('This field is required')
        $('input[name=interview]').focus()
        flag.push(false)
        return false
    }

    if($('input[name=paper_setter]:checked').val()==='No' && $('input[name=interview]:checked').val()==='No'){
        $('#valid_interview').html('Atleast one of the option is selected to yes')
        $('input[name=interview]').focus()
        flag.push(false)
        return false
    }

    $("#preference_fieldset .prefrence_input").each(function(key,value){

        if($(this).attr('id')==='brief'){
            if($('#brief').parent().hasClass('d-none') || $('input[name=interview]:checked').val()==='No'){
                flag.push(true)
            }else{
                if($('#brief').val()===''){
                    flag.push(false)
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
                if($(this).attr('id')==='pin_code'){
                    if($(this).val().length<6){
                        flag.push(false)
                        $('#'+$(this).attr('id')).focus()
                        $('#valid_'+$(this).attr('id')).html('Please Enter Valid Pincode')
                        return false
                    }
                    else{
                        $('#valid_'+$(this).attr('id')).html('')
                    }
                }
                else{
                    $('#valid_'+$(this).attr('id')).html('')
                }
            }
        }
        data[$(this).attr('id')]=$(this).val()
    });

    if($('input[name=enquiry]:checked').length !== 0){
        $('#valid_enquiry').html('')
        flag.push(true)
        data['enquiry']=$('input[name=enquiry]:checked').val()
    }
    else{
        $('#valid_enquiry').html('This field is required')
        $('input[name=enquiry]').focus()
        flag.push(false)
        return false
    }

    if(flag.includes(false)){
        return false
    }
    else{
        if(languageDataStatus){
            $('#notify-message').html('')
             $.ajax({
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data:JSON.stringify(data),
                url: base_url+'add/Preference',
                success:function(response){

                }
            })
            return true
        }
        else{
            // $('#language_error').html('Please add the language proficience details')
            $('#notify-message').html('Please add the language proficience details')
            $('#NotifyModal').modal('show')
            return false
        }
    }
}