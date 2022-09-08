
$('#edit-form').click(()=>{
    $.ajax({
        type: "GET",
        url: base_url+'edit/Form',
        success:function(){
            location.reload()
        }
    })
})

$('#final-submit').click(()=>{
    if($('#declaration').is(":checked")){
        $.ajax({
            type: "GET",
            url: base_url+'final/submit',
            success:function(){
                alert('Your online application has been submitted successfully.')
                location.href='profile'
            }
        })
    }
    else{
        alert('Please select the declaration.')
    }
})
