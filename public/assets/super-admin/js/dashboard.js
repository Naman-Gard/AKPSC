$('document').ready(()=>{
    $("#AddUserModal").modal({
        backdrop: 'static',
        keyboard: false
    });
})

$('#add-section').on('submit',(e)=>{
    e.preventDefault()
    let flag=doValidation()
    if(flag){
        let data={
            'email':$('input[name=email]').val(),
            'mobile':$('input[name=mobile]').val(),
            'status':'0'
        }
        $.ajax({
            type: "GET",
            url: base_url + 'secure-superadmin/check/isEmailRegistered/'+btoa(JSON.stringify(data)),
            success:function(response){

                if(response.status==='Already Exist'){
                    $('#valid_email').html("This Email is already registered");
                    $('#valid_mobile').html("This Mobile is already registered");
                }
                else if(response.status==='Mobile Already Exist'){
                    $('#valid_email').html("");
                    $('#valid_mobile').html("This Mobile is already registered");
                }
                else if(response.status==='Email Already Exist'){
                    $('#valid_email').html("This Email is already registered");
                    $('#valid_mobile').html("");
                }
                else{
                    $('#valid_email').html("");
                    $('#valid_mobile').html("");
                    e.currentTarget.submit();
                }

            }
        })
    }
})

function doValidation() {
    let flag=[]
    
    if ($('input[name=mobile]').val() !== '') {
        if($('input[name=mobile]').val().length<10){
            flag.push(false)
            $('#valid_mobile').html("Please enter valid mobile");
        }
        else{
            $('#valid_mobile').html("");
        }
    }
    else{
        flag.push(false)
        $('#valid_mobile').html("Please enter valid mobile");
    } 

    let email = $('input[name=email]').val()
    let valid =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email.toLowerCase().match(valid)) {
        $('#valid_email').html("");
    } else {
        flag.push(false)
        $('#valid_email').html("Please enter valid email");
    }
    
    return flag.includes(false)?false:true
}

$('input[name=name]').keydown((e) => {

    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (!(keyCode >= 65 && keyCode <= 123)
                        && (keyCode != 32 && keyCode != 0)
                        && (keyCode != 48 && keyCode != 8)
                        && (keyCode != 9)) {
        e.preventDefault();
    }
})

$('input[name=mobile]').keydown((e) => {
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (e.currentTarget.value.length == 10 && keyCode!==8)
        return false;
    
    return e.ctrlKey || e.altKey 
                || (47<e.keyCode && e.keyCode<58 && e.shiftKey==false) 
                || (95<e.keyCode && e.keyCode<106)
                || (e.keyCode==8) || (e.keyCode==9) 
                || (e.keyCode>34 && e.keyCode<40) 
                || (e.keyCode==46)
})

$('#save-section').on('submit',(e)=>{
    e.preventDefault()
    let flag=doValidation()
    if(flag){
        let data={
            'email':$('input[name=email]').val(),
            'mobile':$('input[name=mobile]').val(),
            'status':$('input[name=id]').val()
        }
        $.ajax({
            type: "GET",
            url: base_url + 'secure-superadmin/check/isEmailRegistered/'+btoa(JSON.stringify(data)),
            success:function(response){

                if(response.status==='Already Exist'){
                    $('#valid_email').html("This Email is already registered");
                    $('#valid_mobile').html("This Mobile is already registered");
                }
                else if(response.status==='Mobile Already Exist'){
                    $('#valid_email').html("");
                    $('#valid_mobile').html("This Mobile is already registered");
                }
                else if(response.status==='Email Already Exist'){
                    $('#valid_email').html("This Email is already registered");
                    $('#valid_mobile').html("");
                }
                else{
                    $('#valid_email').html("");
                    $('#valid_mobile').html("");
                    e.currentTarget.submit();
                }

            }
        })
    }
})