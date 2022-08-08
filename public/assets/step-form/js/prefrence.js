$('input[name=enquiry]').change((e)=>{
    if(e.target.value==='yes'){
        $('#brief').parent().removeClass('d-none')
    }
    else{
        $('#brief').parent().addClass('d-none')
        $('#brief').val('')
    }
})

$('input[name=pin_code]').keydown((e) => {
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (e.currentTarget.value.length === 6 && keyCode!==8)
    {
        return false;
    }
    if ((keyCode > 64 && keyCode < 91) || (keyCode > 96 && keyCode < 123)) {
        e.preventDefault();
    }
})

function languageValidation(){
    let data={
        "_token":token
    }
    if($('#language').val() !== ''){
        $('#valid_language').html('')
        data['language']=$('#language').val()
    }
    else{
        $('#valid_language').html('This field is required')
        $('#language').focus()
        return false
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
                            <input type="button" class="btn btn-danger btn-sm" data-id="${item.id}" data-heading="language" data-bs-toggle="modal" data-bs-target="#DeleteModal" value="Delete">
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

    $("#preference_fieldset .prefrence_input").each(function(key,value){

        if($(this).attr('id')==='brief'){
            if($('#brief').parent().hasClass('d-none')){
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
                $('#valid_'+$(this).attr('id')).html('')
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