$('input[name=enquiry]').click((e)=>{
    if(e.target.value==='yes'){
        $('#brief').parent().removeClass('d-none')
    }
    else{
        $('#brief').parent().addClass('d-none')
    }
})

function preferenceValidation(){
    let flag=[]
    let data={
        "_token":token
    }

    if($('input[name=paper_setter]:checked').length !== 0){
        $('#valid_paper_setter').html('')
        flag.push(true)
        data['paper_setter']=$('input[name=paper_setter]').val()
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
        data['interview']=$('input[name=interview]').val()
    }
    else{
        $('#valid_interview').html('This field is required')
        $('input[name=interview]').focus()
        flag.push(false)
        return false
    }

    if($('input[name=enquiry]:checked').length !== 0){
        $('#valid_enquiry').html('')
        flag.push(true)
        data['enquiry']=$('input[name=enquiry]').val()
    }
    else{
        $('#valid_enquiry').html('This field is required')
        $('input[name=enquiry]').focus()
        flag.push(false)
        return false
    }

    $("#work_preference_fieldset .prefrence_input").each(function(key,value){

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
                console.log($(this).attr('id'))
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
            url: base_url+'preference',
        }).done((response)=>{
            
        })
        return true
    }
}