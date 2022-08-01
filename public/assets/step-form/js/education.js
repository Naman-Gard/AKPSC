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

// $('#super_specialization').change((e)=>{
//     if(e.target.value===''){
//         $('#degree').empty()
//         $('#degree').append(`<option value="">Select</option>`)
//     }
//     else{
//         $('#degree').empty()
//         $('#degree').append(`<option value="">Select</option>`)
//         $('#degree').append(`<option value="Graduation">Graduation</option>`)
//     }
// })

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
    $("#education_fieldset select").each(function(key,value){
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
            url: base_url+'education',
            success:function(){
                $('#education_list').load(location.href+" #education_list>*","")
                $("#education_fieldset select").each(function(key,value){
                    $('#'+$(this).attr('id')).val('')
                })
            }
        })
        return true
    }
    // return flag.includes(false)?false:true
}

$('#add-details').click(async ()=>{
    educationValidation()
})

function finalEduactionValidation(){
    // return true
    if(education_data!=='0'){
        $.ajax({
            type: "GET",
            url: base_url+'final-save/education',
        })
        return true
    }
    else{
        return false
    }
}