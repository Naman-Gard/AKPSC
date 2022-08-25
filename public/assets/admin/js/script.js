
let table=$('.action-table').DataTable({
            searching: false,

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

function getUsers(){
    $.ajax({
        type: "GET",
        url: base_url+'secure-admin/getUsers',
        success:function(response){
            users=response
            setUsers()
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
});

$('#BlackListModal').on('show.bs.modal', function(e) {
    $('#id').val($(e.relatedTarget).data('id'))
});

$('#AppointedModal').on('show.bs.modal', function(e) {
    $('#appoint_user_id').val($(e.relatedTarget).data('id'))
});

$('#add-empanel').on('submit', function (e) {

    e.preventDefault();
    let flag=doEmpanelValidation()
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

$(".date").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    yearRange: '1957:2025'
});