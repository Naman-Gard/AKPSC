$('#type').change((e)=>{
    if(e.target.value==='other'){
        $('#specify').parent().removeClass('d-none')
    }
    else{
        $('#specify').parent().addClass('d-none')
    }
})

function experienceValidation(){
    let flag=[]
    let data={
        "_token":token
    }
    if($('input[name=isworking]:checked').length !== 0){
        $('#valid_isworking').html('')
        flag.push(true)
        data['isworking']=$('input[name=isworking]').val()
    }
    else{
        $('#valid_isworking').html('This field is required')
        $('input[name=isworking]').focus()
        flag.push(false)
        return false
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
            url: base_url+'experience',
        }).done((response)=>{
            // console.log('done')
        })
        return true
    }
}