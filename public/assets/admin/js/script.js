$('document').ready(() => {
    let table = $('.action-table').DataTable({
        // searching: false,
        scrollX: true,
        autoWidth: true,
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
        scrollX: true,
        autoWidth: true,
        buttons: [
            'excel'
        ]
    });

    $('.masters-table').DataTable({
        dom: 'lBfrtip',
        // scrollX: false,
        // autoWidth: true,
        buttons: [
            'excel'
        ]
    });

    $('#subject').change((e) => {
        $('#specialization').empty()
        $('#super_specialization').empty()
        $('#specialization').append(`<option value="">Select</option>`)
        $('#super_specialization').append(`<option value="">Select</option>`)
        if (e.target.value !== '') {
            subjects[e.target.value].forEach((specialization) => {
                $('#specialization').append(`<option value="${specialization.specialization}">${specialization.specialization}</option>`)
                $('#super_specialization').append(`<option value="${specialization.specialization}">${specialization.specialization}</option>`)
            })
        }
        setUsers()
    })
    $('#specialization').change(() => {
        setUsers()
    })
    $('#super_specialization').change(() => {
        setUsers()
    })

    $("#EmpanelModal").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#AppointedModal").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#BlackListModal").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#AddDegreeType").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#AddDegreeName").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#AddSubject").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#RemoveModal").modal({
        backdrop: 'static',
        keyboard: false
    });

    function getUsers() {
        $('#LoaderModal').modal('show')
        $.ajax({
            type: "GET",
            url: base_url + 'secureadmin/getSubjects',
            success: function (response) {
                subjects = response
            }
        })
        $.ajax({
            type: "GET",
            url: base_url + 'secureadmin/getUsers',
            success: function (response) {
                users = response
                setUsers()
            }
        })
    }

    function setUsers() {
        table.clear().draw();
        $('#LoaderModal').modal()
        temp_users = Object.keys(users)

        $('.dashboard-filter').each((key, item) => {
            // console.log($(item).attr('id'))
            if ($('#' + $(item).attr('id')).val() !== '') {
                if (!$('#' + $(item).attr('id')).hasClass('selected-filter')) {
                    $('#' + $(item).attr('id')).addClass('selected-filter')
                }
            }
            else {
                if ($(item).attr('id') !== 'report_experts') {
                    $('#' + $(item).attr('id')).removeClass('selected-filter')
                }
            }

        })

        if ($('#subject').val() !== '') {
            temp_users = temp_users.filter((user) => {
                let temp_subjects = users[user]["subject"].map((el) => {
                    return el.toLowerCase()
                })
                return temp_subjects.includes(
                    $("#subject").val().toLowerCase()
                );
            })

        }
        if ($('#specialization').val() !== '') {
            temp_users = temp_users.filter((user) => {
                let temp_subjects = users[user]["specialization"].map((el) => {
                    return el.toLowerCase()
                })
                return temp_subjects.includes(
                    $("#specialization").val().toLowerCase()
                );
            })
        }
        if ($('#super_specialization').val() !== '') {
            temp_users = temp_users.filter((user) => {
                let temp_subjects = users[user]["super_specialization"].map((el) => {
                    return el.toLowerCase()
                })
                return temp_subjects.includes(
                    $("#super_specialization").val().toLowerCase()
                );
            })
        }

        if (temp_users.length) {
            temp_users.forEach((user, index) => {
                let exp = []
                users[user]['experience'].forEach((experience) => {
                    exp.push(experience['type'] + ':' + experience['year'])
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
                let innerhtml = [
                    index + 1,
                    `<a href="${base_url}assets/uploads/cv/${users[user]['cv']}" target="_blank" download=${users[user]['name']}>${users[user]['register_id']}</a>`,
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
        $('#LoaderModal').modal('hide')

        // $('#dashboard_users').html(innerhtml)
    }

    getUsers()


    $('#EmpanelModal').on('show.bs.modal', function (e) {
        $('#user_id').val($(e.relatedTarget).data('id'))
        $("#doe").datepicker({
            // changeMonth: true,
            // changeYear: true,
            format: "dd/mm/yyyy",
            // yearRange: '1957:2025',
        });
    });

    $('#BlackListModal').on('show.bs.modal', function (e) {
        $('#id').val($(e.relatedTarget).data('id'))
    });

    let appointed_dates = ''

    $('#AppointedModal').on('show.bs.modal', function (e) {
        $('#appoint_user_id').val($(e.relatedTarget).data('id'))
        appointed_dates = $('#dates-' + $(e.relatedTarget).data('id')).html()

        $("#from").datepicker({
            format: "dd/mm/yyyy",
            change: function (e) {
                $("#to").datepicker('destroy')
                changeDates(e.target.value, 'to', 'minDate', 'from', 'maxDate')
            }
            // yearRange: "1957:2025",
        });

        $("#to").datepicker({
            // changeMonth: true,
            // changeYear: true,
            format: "dd/mm/yyyy",
            change: function (e) {
                $("#from").datepicker().destroy()
                changeDates(e.target.value, 'from', 'maxDate', 'to', 'minDate')
            }
        });

    });
    // $('#AppointedModal').on('show.bs.modal', function(e) {
    //     $('#appoint_user_id').val($(e.relatedTarget).data('id'))
    //     appointed_dates=$('#dates-'+$(e.relatedTarget).data('id')).html()

    //     $( "#from" ).datepicker({   
    //         // changeMonth: true,
    //         // changeYear: true,
    //         format: "dd/mm/yyyy",
    //         yearRange: '1957:2025',
    //         maxDate:$('#to').val(),
    //         onClose: function( selectedDate ) {  
    //             $( "#to" ).datepicker( "option", "minDate", selectedDate );  
    //             $( "#from" ).datepicker( "destroy" );  
    //             $('#to').focus()
    //         }  
    //     });
    //     $( "#to" ).datepicker({
    //         // changeMonth: true,
    //         // changeYear: true,
    //         format: "dd/mm/yyyy",
    //         // yearRange: '1957:2025',
    //         minDate:$('#from').val(),
    //         onClose: function( selectedDate ) {
    //             $( "#from" ).datepicker( "option", "maxDate", selectedDate );
    //             $( "#to" ).datepicker( "destroy" );
    //             $('#from').focus()
    //         }
    //     });

    // });

    $('#add-empanel').on('submit', function (e) {

        e.preventDefault();
        let flag = doEmpanelValidation()
        if (flag && dateIsValid($('#doe').val(), 'doe')) {
            e.currentTarget.submit();
        }

    });

    $('#appointed').on('submit', function (e) {

        e.preventDefault();
        if (dateIsValid($('#from').val(), 'from') && dateIsValid($('#to').val(), 'to')) {
            let flag = doAppointedValidation()
            if (flag) {
                e.currentTarget.submit();
                $('#valid_apoint').html('')
            }
            else {
                $('#valid_apoint').html('Expert already appointed for these dates')
            }
        }

    });

    $('#blacklisted').on('submit', function (e) {

        e.preventDefault();
        let flag = doBlackListValidation()
        if (flag) {
            e.currentTarget.submit();
        }

    });

    function doEmpanelValidation() {
        let flag = []
        $('#add-empanel .empanel_input').each((key, value) => {
            if ($(value).val() === '') {
                flag.push(false)
                $('#' + $(value).attr('id')).focus()
                $('#valid_' + $(value).attr('id')).html('This field is required')
                return false
            }
            else {
                $('#valid_' + $(value).attr('id')).html('')
            }
        })

        if ($('#secret_code2').val() === $('#secret_code1').val() && $('#secret_code1').val() !== '') {
            flag.push(false)
            $('#valid_secret_code2').html('Secret Codes should be unique')
        }
        else {
            $('#valid_secret_code2').html('')
        }
        return flag.includes(false) ? false : true
    }

    $('input[name=lifespan]').change((e) => {
        if (e.target.value === 'years') {
            $('#n_years').removeClass('d-none')
        }
        else {
            if (!$('#n_years').hasClass('d-none')) {
                $('#n_years').addClass('d-none')
            }
        }
    })

    function doBlackListValidation() {
        // if($('#lifespan').val()!==''){
        //     $('#valid_lifespan').html('')
        //     return true
        // }else{
        //     $('#valid_lifespan').html('The Field is required')
        //     return false
        // }

        if ($('input[name=lifespan]:checked').length !== 0) {

            if ($('input[name=lifespan]:checked').val() === 'years') {
                if ($('input[name=n_years]').val() !== '') {
                    $('#valid_n_years').html('')
                }
                else {
                    $('#valid_lifespan').html('')
                    $('#valid_n_years').html('This field is required')
                    return false
                }
            }

            $('#valid_lifespan').html('')
            return true
        }
        else {
            $('#valid_lifespan').html('This field is required')
            $('input[name=lifespan]').focus()
            return false
        }
    }

    function doAppointedValidation() {
        let flag = []
        appointed_dates = appointed_dates.replace(/\s+/g, ' ').trim()
        temp_dates = appointed_dates.split(',')

        if (temp_dates[0] !== 'Not Appointed Yet') {
            temp_dates.forEach((dates) => {
                dates = dates.trim()
                dates = dates.replace('(', '')
                dates = dates.replace(')', '')
                dates = dates.split('-')
                flag.push(dateCheck(dates[0], dates[1], $('#from').val()))
                flag.push(dateCheck(dates[0], dates[1], $('#to').val()))
                flag.push(dateCheck($('#from').val(), $('#to').val(), dates[0]))
                flag.push(dateCheck($('#from').val(), $('#to').val(), dates[1]))
            })
        }

        return flag.includes(false) ? false : true
    }

    function dateCheck(from, to, check) {

        var fDate, lDate, cDate;
        fDate = Date.parse(from.split('/')[1] + '/' + from.split('/')[0] + '/' + from.split('/')[2]);
        lDate = Date.parse(to.split('/')[1] + '/' + to.split('/')[0] + '/' + to.split('/')[2]);
        cDate = Date.parse(check.split('/')[1] + '/' + check.split('/')[0] + '/' + check.split('/')[2]);
        if ((cDate <= lDate && cDate >= fDate)) {
            return false;
        }
        return true;
    }


    function dateIsValid(dateStr, valid) {
        const regex = /^\d{2}\/\d{2}\/\d{4}$/;
        if (dateStr.match(regex) === null) {
            $('#valid_' + valid).html('Please enter valid date')
            return false;
        }

        const [day, month, year] = dateStr.split('/');

        // 👇️ format Date string as `yyyy-mm-dd`
        const isoFormattedStr = `${year}-${month}-${day}`;

        const date = new Date(isoFormattedStr);

        const timestamp = date.getTime();

        if (typeof timestamp !== 'number' || Number.isNaN(timestamp)) {
            $('#valid_' + valid).html('Please enter valid date')
            return false;
        }

        if (parseInt(year) > 2022) {
            $('#valid_' + valid).html('Please enter valid date')
            return false;
        }
        $('#valid_' + valid).html('')
        return true;
    }

    // $( "#from" ).focus(()=>{
    //     $( "#from" ).datepicker({   
    //         changeMonth: true,
    //         changeYear: true,
    //         dateFormat: "dd/mm/yy",
    //         yearRange: '1957:2025',
    //         maxDate:$('#to').val(),
    //         onClose: function( selectedDate ) {  
    //             $( "#to" ).datepicker( "option", "minDate", selectedDate );  
    //             $( "#from" ).datepicker( "destroy" );  
    //             $('#to').focus()
    //         }  
    //     }).show();
    // })

    // $( "#to" ).focus(()=>{ 
    //     $( "#to" ).datepicker({
    //         changeMonth: true,
    //         changeYear: true,
    //         dateFormat: "dd/mm/yy",
    //         yearRange: '1957:2025',
    //         minDate:$('#from').val(),
    //         onClose: function( selectedDate ) {
    //             $( "#from" ).datepicker( "option", "maxDate", selectedDate );
    //             $( "#to" ).datepicker( "destroy" );
    //             $('#from').focus()
    //         }
    //     }).show();
    // })

    // sidebar
    var togglebtn = document.querySelector(".toggle-btn");
    if ($(window).width() < 992) {
        togglebtn.addEventListener("click", () => {
            $(".sidebar").toggleClass("active");

        });
    }

    function changeDates(value, type, date, type2, date2) {
        $("#" + type).datepicker({
            format: "dd/mm/yyyy",
            value: $('#' + type).val(),
            [date]: value,
            change: function (e) {
                $("#" + type2).datepicker().destroy()
                changeDates(e.target.value, type2, date2, type, date)
            }
        });
    }

})