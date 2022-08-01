$(document).ready(function(){
    
    let current_fs, next_fs, previous_fs; //fieldsets
    let opacity,previous_data;

    $("#"+step+'_fieldset').css({
        'display': 'block',
        'position': 'relative'
    })
    if(step!=='education'){
        $("#education_fieldset").css({
            'display': 'none',
            'position': 'relative'
        })
    }
    
    $(".next").click(function(){
        let isValidated=false
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        const current_id=$(this).attr('id')

        if(current_id==='education'){
            isValidated=finalEduactionValidation()
        }
        else if(current_id==='experience'){
            isValidated=experienceValidation()
        }
        else if(current_id==='work_preference'){
            isValidated=preferenceValidation()
        }

        if(isValidated){
            //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
        }
    });
    
    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        const previous_id=$(this).attr('id')
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        if(previous_id!==undefined){
            $.ajax({
                type: "GET",
                url: base_url+'get'+previous_id.split('_')[0]+'Data',
            }).done((response)=>{
                if(response.length){
                    previous_data=response[0]
                    setSaveData(previous_id.split('_')[0])
                }
            })
        }
        
        //show the previous fieldset
        previous_fs.show();
    
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
    
    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });
    
    $(".submit").click(function(){
        return false;
    })

    function setSaveData(step){
        console.log(previous_data)
        if(step==='Experience'){
            $('#designation option[value="'+previous_data.designation+'"]').prop("selected",true).change()
            $('#serving option[value="'+previous_data.serving+'"]').prop("selected",true).change()
            $('#type option[value="'+previous_data.type+'"]').prop("selected",true).change()
            $('#year option[value="'+previous_data.year+'"]').prop("selected",true).change()
            $('#org_type option[value="'+previous_data.org_type+'"]').prop("selected",true).change()
            $('#org_year option[value="'+previous_data.org_year+'"]').prop("selected",true).change()
            $('#org_name').val(previous_data.org_name)
            $('input[name=isworking][value="'+previous_data.isworking+'"]').attr('checked',true).change()
        }
        else{
            $('#line_1').val(previous_data.line_1)
            $('#line_2').val(previous_data.line_2)
            $('#pin_code').val(previous_data.pincode)
            // $('input[name=enquiry][value="'+previous_data.enquiry+'"]').prop('checked',true).change()
            $('input[name=enquiry]').val([previous_data.enquiry]).change()
            $('input[name=paper_setter][value="'+previous_data.paper_setter+'"]').attr('checked',true).change()
            $('input[name=interview][value="'+previous_data.interview+'"]').attr('checked',true).change()
            if(previous_data.enquiry==='yes'){
                $('#brief').parent().removeClass('d-none')
                $('#brief').val(previous_data.brief)
            }
            else{
                $('#brief').parent().addClass('d-none')
                $('#brief').val('')
            }
        }
    }
        
});