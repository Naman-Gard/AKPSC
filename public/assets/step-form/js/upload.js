function readURL(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
            $('#'+id).parent().removeClass('d-none');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function(e){
    readURL(this,'image_preview');
});

$("#signature").change(function(){
    readURL(this,'sig_preview');
});

function imageValidation(value,id){
    let extensions=['jpeg','jpg','png','svg','JPEG','JPG','PNG','SVG']
    let temp=value.split('\\')
    let ext=temp[temp.length-1].split('.')[1]
    if(extensions.includes(ext)){
        $('#'+id).parent().removeClass('d-none');
    }
    else{
        $('#'+id).parent().addClass('d-none');
    }
}