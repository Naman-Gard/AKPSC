
let table=$('.action-table').DataTable({
    // searching: false,

    // dom: 'lBfrtip',
    // buttons: [
    // 'copy', 'csv', 'excel', 'print',
    //     {
    //         extend: 'pdfHtml5',
    //         orientation: 'landscape',
    //         pageSize: 'A4'
    //     }
    // ]
});

let report_table=$('.report-table').DataTable({
            dom: 'lBfrtip',
            buttons: [
            'excel'
            ]
        });

$('.users-table').DataTable({
    dom: 'lBfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'print',
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'A4'
        }
    ]
});
let users=[];
let report_users=[];

function getUsers(){
    $.ajax({
        type: "GET",
        url: base_url+'secure-admin/getUsers',
        success:function(response){
            users=response
            setUsers()
        }
    })

    $.ajax({
        type: "GET",
        url: base_url+'secure-admin/getReportUsers',
        success:function(response){
            report_users=response
            setReportUsers()
        }
    })
}

getUsers()

$('#subject').change(()=>{
    setUsers()
})
$('#specialization').change(()=>{
    setUsers()
})
$('#super_specialization').change(()=>{
    setUsers()
})

function setUsers(){
    table.clear().draw();

    temp_users=Object.keys(users)
    
    if($('#subject').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return users[user]['subject'].includes($('#subject').val())
        })
        
    }
    if($('#specialization').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return users[user]['specialization'].includes($('#specialization').val())
        })
    }
    if($('#super_specialization').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return users[user]['super_specialization'].includes($('#super_specialization').val())
        })
    }

    if(temp_users.length){
        temp_users.forEach((user,index)=>{
            let exp=[]
            users[user]['experience'].forEach((experience)=>{
                exp.push(experience['type']+':'+experience['year'])
            })
            // innerhtml.push(`<tr>
            //             <th>${index+1}</th>
            //             <td>${users[user]['register_id']}</td>
            //             <td>${users[user]['name']}</td>
            //             <td>${users[user]['mobile']}</td>
            //             <td>${users[user]['subject'].toString()}</td>
            //             <td>${exp.toString()}</td>                   
            //             <td>
            //                 <button class="btn btn-sm p-2 btn-primary">Empanel</button>
            //                 <button class="btn btn-sm p-2 btn-primary">Blacklist</button>
            //             </td>
            //         </tr>`)
            let innerhtml=[
                index+1,
                `<a target="_blank">${users[user]['register_id']}</a>`,
                users[user]['name'],
                users[user]['mobile'],
                users[user]['subject'].toString(),
                users[user]['specialization'].toString(),
                exp.toString(),
                `<button data-id="${user}" data-bs-toggle="modal" data-bs-target="#EmpanelModal" class="btn btn-sm p-2 btn-primary">Empanel</button>`
                // <button data-id="${user}" data-bs-toggle="modal" data-bs-target="#BlackListModal" class="btn btn-sm p-2 btn-primary">Blacklist</button>`
            ]
            table.row.add(innerhtml).draw()
        })
    }

    // $('#dashboard_users').html(innerhtml)
}

$('document').ready(()=>{
    $("#EmpanelModal").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#BlackListModal").modal({
        backdrop: 'static',
        keyboard: false
    });
})

$('#EmpanelModal').on('show.bs.modal', function(e) {
    $('#user_id').val($(e.relatedTarget).data('id'))
    $( "#doe" ).datepicker({   
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '1957:2025',
    });
});

$('#BlackListModal').on('show.bs.modal', function(e) {
    $('#id').val($(e.relatedTarget).data('id'))
});

let appointed_dates=''

$('#AppointedModal').on('show.bs.modal', function(e) {
    $('#appoint_user_id').val($(e.relatedTarget).data('id'))
    appointed_dates=$('#dates-'+$(e.relatedTarget).data('id')).html()

     $( "#from" ).datepicker({   
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '1957:2025',
        onClose: function( selectedDate ) {  
            $( "#to" ).datepicker( "option", "minDate", selectedDate );  
        }  
    });  

    $( "#to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '1957:2025',
        onClose: function( selectedDate ) {
            $( "#from" ).datepicker( "option", "maxDate", selectedDate );
        }
    });  
});

$('#add-empanel').on('submit', function (e) {

    e.preventDefault();
    let flag=doEmpanelValidation()
    if(flag && dateIsValid($('#doe').val())){
        e.currentTarget.submit();
    }

});

$('#appointed').on('submit', function (e) {

    e.preventDefault();
    let flag=doAppointedValidation()
    console.log(flag)
    if(flag){
        e.currentTarget.submit();
    }

});

$('#blacklisted').on('submit', function (e) {

    e.preventDefault();
    let flag=doBlackListValidation()
    if(flag){
        e.currentTarget.submit();
    }

});

function doEmpanelValidation(){
    let flag=[]
    $('#add-empanel .empanel_input').each((key,value)=>{
        if($(value).val()===''){
            flag.push(false)
            $('#'+$(value).attr('id')).focus()
            $('#valid_'+$(value).attr('id')).html('This field is required')
            return false
        }
        else{
            $('#valid_'+$(value).attr('id')).html('')
        }
    })

    if($('#secret_code2').val()===$('#secret_code1').val() && $('#secret_code1').val()!==''){
        flag.push(false)
        $('#valid_secret_code2').html('Secret Codes should be unique')
    }
    else{
        $('#valid_secret_code2').html('')
    }
    return flag.includes(false)?false:true
}

$('input[name=lifespan]').change((e)=>{
    if(e.target.value==='years'){
        $('#n_years').removeClass('d-none')
    }
    else{
        if(!$('#n_years').hasClass('d-none')){
            $('#n_years').addClass('d-none')
        }
    }
})

function doBlackListValidation(){
    // if($('#lifespan').val()!==''){
    //     $('#valid_lifespan').html('')
    //     return true
    // }else{
    //     $('#valid_lifespan').html('The Field is required')
    //     return false
    // }

    if($('input[name=lifespan]:checked').length !== 0){

        if($('input[name=lifespan]:checked').val()==='years'){
            if($('input[name=n_years]').val()!==''){
                $('#valid_n_years').html('')
            }
            else{
                $('#valid_lifespan').html('')
                $('#valid_n_years').html('This field is required')
                return false
            }
        }

        $('#valid_lifespan').html('')
        return true
    }
    else{
        $('#valid_lifespan').html('This field is required')
        $('input[name=lifespan]').focus()
        return false
    }
} 

function doAppointedValidation(){
    let flag=[]
    appointed_dates=appointed_dates.replace(/\s+/g,' ').trim()
    temp_dates=appointed_dates.split(',')
    if(temp_dates[0]!=='Not Appointed Yet')
    temp_dates.forEach((dates)=>{
        dates=dates.trim()
        dates=dates.replace('(','')
        dates=dates.replace(')','')
        dates=dates.split('-')
        flag.push(dateCheck(dates[0],dates[1],$('#from').val()))
        flag.push(dateCheck(dates[0],dates[1],$('#to').val()))
    })

    return flag.includes(false)?false:true
}

function dateCheck(from,to,check) {

    var fDate,lDate,cDate;
    fDate = Date.parse(from.split('/')[1]+'/'+from.split('/')[0]+'/'+from.split('/')[2]);
    lDate = Date.parse(to.split('/')[1]+'/'+to.split('/')[0]+'/'+to.split('/')[2]);
    cDate = Date.parse(check.split('/')[1]+'/'+check.split('/')[0]+'/'+check.split('/')[2]);
    if((cDate <= lDate && cDate >= fDate)) {
        return false;
    }
    return true;
}


function dateIsValid(dateStr){
    const regex = /^\d{2}\/\d{2}\/\d{4}$/;

    if (dateStr.match(regex) === null) {
        $('#valid_doe').html('Please enter valid date')
        return false;
    }

    const [day, month, year] = dateStr.split('/');

    // 👇️ format Date string as `yyyy-mm-dd`
    const isoFormattedStr = `${year}-${month}-${day}`;

    const date = new Date(isoFormattedStr);

    const timestamp = date.getTime();

    if (typeof timestamp !== 'number' || Number.isNaN(timestamp)) {
        $('#valid_doe').html('Please enter valid date')
        return false;
    }

    if (parseInt(year)>2022) {
        $('#valid_doe').html('Please enter valid date')
        return false;
    }
    $('#valid_doe').html('')
    return true;
}

function reportFilters(temp_users){

    if($('#report_experts').val()!==''){
        if($('#report_experts').val()==='Empanelled'){
            temp_users=temp_users.filter((user)=>{
                return report_users[user]['empanelled']==='1'
            })
        }
        if($('#report_experts').val()==='Blacklisted'){
            temp_users=temp_users.filter((user)=>{
                return report_users[user]['blacklisted']==='1'
            })
        }        
    }

    if($('#report_subject').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return report_users[user]['subject'].includes($('#report_subject').val())
        })
        
    }

    if($('#report_specialization').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return report_users[user]['specialization'].includes($('#report_specialization').val())
        })
    }

    if($('#t_experience').val()!==''){
        temp_users=temp_users.filter((user)=>{
            let total_exp=0;
            report_users[user]['experience'].forEach((exp)=>{
                total_exp+=parseInt(exp['year'])
            })
            return total_exp>=parseInt($('#t_experience').val())
        })
    }

    if($('#report_language').val()!==''){
        const language=$('#report_language').val().split(':')[0]
        const proficiency=$('#report_language').val().split(':')[1]
        temp_users=temp_users.filter((user)=>{
            let flag=false
            report_users[user]['language'].forEach((lang)=>{
                if(lang['language']===language && lang['proficiency']===proficiency){
                    flag=true
                    return false
                }
            })
            return flag===true
        })
    }

    if($('#report_qual').val()!==''){
        temp_users=temp_users.filter((user)=>{
            let flag=false
            report_users[user]['qualification'].forEach((qual)=>{
                if(qual['degree']===$('#report_qual').val()){
                    flag=true
                    return false
                }
            })
            return flag===true
        })
    }

    if($('#w_status').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return report_users[user]['isworking']===$('#w_status').val()
        })
    }

    if($('#designation').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return report_users[user]['designation']===$('#designation').val()
        })
    }

    if($('#gender').val()!==''){
        temp_users=temp_users.filter((user)=>{
            return report_users[user]['gender']===$('#gender').val()
        })
    }

    if($('#age').val()!==''){
        temp_users=temp_users.filter((user)=>{
            const age=userAge(report_users[user]['dob'])
            return age>=parseInt($('#age').val())
        })
    }

    if($('#report-from').val()!==''){
        if($('#report_experts').val()===''){
            temp_users=temp_users.filter((user)=>{
                const date=report_users[user]['from'].split(' ')[0].split('-')
                const flag=dateFrom($('#report-from').val(),date[1]+'/'+date[2]+'/'+date[0])
                return flag
            })
        }
        if($('#report_experts').val()==='Empanelled'){
            temp_users=temp_users.filter((user)=>{
                const date=report_users[user]['date_of_empanel'].split('/')
                const flag=dateFrom($('#report-from').val(),date[1]+'/'+date[0]+'/'+date[2])
                return flag
            })
        }
    }

    if($('#report-to').val()!==''){
        if($('#report_experts').val()===''){
            temp_users=temp_users.filter((user)=>{
                const date=report_users[user]['from'].split(' ')[0].split('-')
                const flag=dateTo($('#report-to').val(),date[1]+'/'+date[2]+'/'+date[0])
                return flag
            })
        }
        if($('#report_experts').val()==='Empanelled'){
            temp_users=temp_users.filter((user)=>{
                const date=report_users[user]['date_of_empanel'].split('/')
                const flag=dateTo($('#report-to').val(),date[1]+'/'+date[0]+'/'+date[2])
                return flag
            })
        }
        
    }

    return temp_users
}

function setReportUsers(){
    report_table.clear().draw();

    temp_users=Object.keys(report_users)
    temp_users=reportFilters(temp_users)
    
    if(temp_users.length){
        temp_users.forEach((user,index)=>{
            let exp=[]
            report_users[user]['experience'].forEach((experience)=>{
                exp.push(experience['type']+':'+experience['year'])
            })
            let language=[]
            report_users[user]['language'].forEach((lang)=>{
                language.push(lang['language']+':'+lang['proficiency'])
            })
            let qualification=[]
            report_users[user]['qualification'].forEach((qual)=>{
                qualification.push(qual['name'])
            })
            let innerhtml=[
                index+1,
                `<a target="_blank">${report_users[user]['register_id']}</a>`,
                report_users[user]['empanelment_id']?report_users[user]['empanelment_id']:'-',
                report_users[user]['name'],
                report_users[user]['email'],
                report_users[user]['mobile'],
                report_users[user]['subject'].toString(),
                report_users[user]['specialization'].toString(),
                qualification.toString(),
                report_users[user]['isworking'],
                report_users[user]['designation'],
                report_users[user]['serving'],
                exp.toString(),
                language.toString(),
                report_users[user]['line_1']+' '+report_users[user]['district']+','+report_users[user]['state']+',Pincode: '+report_users[user]['pincode']
            ]
            report_table.row.add(innerhtml).draw()
        })
    }

}

function userAge(dob) {
    var from = dob.split("/");
    var birthdateTimeStamp = new Date(from[2], from[1] - 1, from[0]);
    var cur = new Date();
    var diff = cur - birthdateTimeStamp;
    // This is the difference in milliseconds
    var currentAge = Math.floor(diff/31557600000);
    // Divide by 1000*60*60*24*365.25

    return currentAge;
}

$('#report_subject').change(()=>{
    setReportUsers()
})
$('#report_specialization').change(()=>{
    setReportUsers()
})
$('#t_experience').change(()=>{
    setReportUsers()
})
$('#report_language').change(()=>{
    setReportUsers()
})
$('#w_status').change(()=>{
    setReportUsers()
})
$('#designation').change(()=>{
    setReportUsers()
})
$('#gender').change(()=>{
    setReportUsers()
})
$('#report_qual').change(()=>{
    setReportUsers()
})
$('#report_experts').change((e)=>{
    if(e.target.value==='Blacklisted'){
        if(!$('#report-from').parent().hasClass('d-none')){
            $('#report-from').parent().addClass('d-none')
        }
        if(!$('#report-to').parent().hasClass('d-none')){
            $('#report-to').parent().addClass('d-none')
        }
    }else{
        $('#report-from').parent().removeClass('d-none')
        $('#report-to').parent().removeClass('d-none')
        $('#report-from').val('')
        $('#report-to').val('')
    }
    setReportUsers()
})
$('#age').change(()=>{
    setReportUsers()
})

$('#report-from').change(()=>{
    setReportUsers()
})

$('#report-to').change(()=>{
    setReportUsers()
})

$( "#report-from" ).datepicker({   
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    yearRange: '1957:2025',
    onClose: function( selectedDate ) {  
        $( "#report-to" ).datepicker( "option", "minDate", selectedDate );  
    }  
}); 
$( "#report-to" ).datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    yearRange: '1957:2025',
    onClose: function( selectedDate ) {
        $( "#report-from" ).datepicker( "option", "maxDate", selectedDate );
    }
});

function dateFrom(from,check) {

    var fDate,cDate;
    fDate = Date.parse(from.split('/')[1]+'/'+from.split('/')[0]+'/'+from.split('/')[2]);
    cDate = Date.parse(check);
    if(cDate >= fDate) {
        return true;
    }
    return false;
}

function dateTo(to,check) {

    var lDate,cDate;
    lDate = Date.parse(to.split('/')[1]+'/'+to.split('/')[0]+'/'+to.split('/')[2]);
    cDate = Date.parse(check);
    if(cDate <= lDate) {
        return true;
    }
    return false;
}

function resetFilters(){
    $('.report-filters').val('')
    setReportUsers()
}