$('document').ready(() => {

    $('#report_subject').change((e) => {
        $('#report_specialization').empty()
        $('#report_super_specialization').empty()
        $('#report_specialization').append(`<option value="">Select</option>`)
        $('#report_super_specialization').append(`<option value="">Select</option>`)
        if(e.target.value!=='')
        {
            subjects[e.target.value].forEach((specialization) => {
                $('#report_specialization').append(`<option value="${specialization.specialization}">${specialization.specialization}</option>`)
                $('#report_super_specialization').append(`<option value="${specialization.specialization}">${specialization.specialization}</option>`)
            })
        }
    })

    $("#LoaderModal").modal({
        backdrop: 'static',
        keyboard: false
    });

    let report_table = $(".report-table").DataTable({
        dom: "lBfrtip",
        scrollX: true,
        autoWidth: true,
        buttons: ["excel"],
    });

    let report_users = [],
        states = {};

    function getReportUsers() {
        $('#LoaderModal').modal('show')
        $.ajax({
            type: "GET",
            url: base_url + "secureadmin/getReportUsers",
            success: function (response) {
                report_users = response;
                setReportUsers();
            },
        });
    }

    function getStates() {
        $.ajax({
            type: "GET",
            url: base_url + "secureadmin/getStates",
            success: function (response) {
                states = response;
            },
        });
    }

    getReportUsers();
    getStates();

    function reportFilters(temp_users) {
        
        $('.gj-textbox-md').each((key,value)=>{
            if(!$('#'+$(value).attr('id')).hasClass('report-filters')){
                $('#'+$(value).attr('id')).addClass('report-filters')
            }
        })

        $('.report-filters').each((key,item)=>{
            // console.log($(item).attr('id'))
            if($('#'+$(item).attr('id')).val()!==''){
                if(!$('#'+$(item).attr('id')).hasClass('selected-filter')){
                    $('#'+$(item).attr('id')).addClass('selected-filter')
                }
            }
            else{
                if($(item).attr('id')!=='report_experts'){
                    $('#'+$(item).attr('id')).removeClass('selected-filter')
                }
            }
            
        })

        if ($("#report_experts").val() !== "") {
            if ($("#report_experts").val() === "Empanelled") {
                temp_users = temp_users.filter((user) => {
                    return report_users[user]["empanelled"] === "1";
                });
            }
            if ($("#report_experts").val() === "Blacklisted") {
                temp_users = temp_users.filter((user) => {
                    return report_users[user]["blacklisted"] === "1";
                });
            }
        }

        if ($("#report_subject").val() !== "") {
            temp_users = temp_users.filter((user) => {
                let temp_subjects=report_users[user]["subject"].map((el)=>{
                    return el.toLowerCase()
                })
                return temp_subjects.includes(
                    $("#report_subject").val().toLowerCase()
                );
            });
        }

        if ($("#report_specialization").val() !== "") {
            temp_users = temp_users.filter((user) => {
                let temp_subjects=report_users[user]["specialization"].map((el)=>{
                    return el.toLowerCase()
                })
                return temp_subjects.includes(
                    $("#report_specialization").val().toLowerCase()
                );
            });
        }

        if ($("#report_super_specialization").val() !== "") {
            temp_users = temp_users.filter((user) => {
                let temp_subjects=report_users[user]["super_specialization"].map((el)=>{
                return el.toLowerCase()
                })
                return temp_subjects.includes(
                    $("#report_super_specialization").val().toLowerCase()
                );
            });
        }

        if ($("#state").val() !== "") {
            temp_users = temp_users.filter((user) => {
                return report_users[user]["state"] == $("#state").val();
            });
        }

        if ($("#district").val() !== "") {
            temp_users = temp_users.filter((user) => {
                return report_users[user]["district"] == $("#district").val();
            });
        }

        if ($("#t_experience").val() !== "") {
            temp_users = temp_users.filter((user) => {
                let total_exp = 0;
                report_users[user]["experience"].forEach((exp) => {
                    total_exp += parseInt(exp["year"]);
                });
                return total_exp >= parseInt($("#t_experience").val());
            });
        }

        if ($("#report_language").val() !== "") {
            const language = $("#report_language").val().split(":")[0];
            const proficiency = $("#report_language").val().split(":")[1];
            temp_users = temp_users.filter((user) => {
                let flag = false;
                report_users[user]["language"].forEach((lang) => {
                    if (
                        lang["language"] === language &&
                        lang["proficiency"] === proficiency
                    ) {
                        flag = true;
                        return false;
                    }
                });
                return flag === true;
            });
        }

        if ($("#report_qual").val() !== "") {
            temp_users = temp_users.filter((user) => {
                let flag = false;
                report_users[user]["qualification"].forEach((qual) => {
                    if (qual["degree"] === $("#report_qual").val()) {
                        flag = true;
                        return false;
                    }
                });
                return flag === true;
            });
        }

        if ($("#w_status").val() !== "") {
            temp_users = temp_users.filter((user) => {
                return report_users[user]["isworking"] === $("#w_status").val();
            });
        }

        if ($("#designation").val() !== "") {
            temp_users = temp_users.filter((user) => {
                return (
                    report_users[user]["designation"] === $("#designation").val()
                );
            });
        }

        if ($("#gender").val() !== "") {
            temp_users = temp_users.filter((user) => {
                return report_users[user]["gender"] === $("#gender").val();
            });
        }

        if ($("#age").val() !== "") {
            temp_users = temp_users.filter((user) => {
                const age = userAge(report_users[user]["dob"]);
                return age >= parseInt($("#age").val());
            });
        }

        if ($("#report-from").val() !== "") {
            if ($("#report_experts").val() === "") {
                temp_users = temp_users.filter((user) => {
                    const date = report_users[user]["dor"].split("/");
                    const flag = dateFrom(
                        $("#report-from").val(),
                        date[1] + "/" + date[0] + "/" + date[2]
                    );
                    return flag;
                });
            }
            if ($("#report_experts").val() === "Empanelled") {
                temp_users = temp_users.filter((user) => {
                    const date = report_users[user]["date_of_empanel"].split("/");
                    const flag = dateFrom(
                        $("#report-from").val(),
                        date[1] + "/" + date[0] + "/" + date[2]
                    );
                    return flag;
                });
            }
        }
        // console.log($("#report-to").val())
        if ($("#report-to").val() !== "") {
            if ($("#report_experts").val() === "") {
                temp_users = temp_users.filter((user) => {
                    const date = report_users[user]["dor"].split("/");
                    const flag = dateTo(
                        $("#report-to").val(),
                        date[1] + "/" + date[0] + "/" + date[2]
                    );
                    return flag;
                });
            }
            if ($("#report_experts").val() === "Empanelled") {
                temp_users = temp_users.filter((user) => {
                    const date = report_users[user]["date_of_empanel"].split("/");
                    const flag = dateTo(
                        $("#report-to").val(),
                        date[1] + "/" + date[0] + "/" + date[2]
                    );
                    return flag;
                });
            }
        }

        return temp_users;
    }

    function setReportUsers() {
        report_table.clear().draw();

        temp_users = Object.keys(report_users);
        $('#LoaderModal').modal();
        temp_users = reportFilters(temp_users);
        if (temp_users.length) {
            temp_users.forEach((user, index) => {
                let exp = [];
                report_users[user]["experience"].forEach((experience) => {
                    exp.push(experience["type"] + ":" + experience["year"]);
                });
                let language = [];
                report_users[user]["language"].forEach((lang) => {
                    language.push(lang["language"] + ":" + lang["proficiency"]);
                });
                let qualification = [];
                report_users[user]["qualification"].forEach((qual) => {
                    qualification.push(qual["name"]);
                });
                        
                let innerhtml = [
                    index + 1,
                    `<a href="${base_url}assets/uploads/cv/${report_users[user]["cv"]}" target="_blank" download=${report_users[user]["name"]}>${report_users[user]["register_id"]}</a>`,
                    report_users[user]["empanelment_id"]
                        ? report_users[user]["empanelment_id"]
                        : "-",
                    report_users[user]["dor"]?report_users[user]["dor"]:'-',
                    report_users[user]["date_of_empanel"]?report_users[user]["date_of_empanel"]:'-',
                    report_users[user]["name"],
                    report_users[user]["father_name"],
                    report_users[user]["dob"],
                    report_users[user]["gender"],
                    report_users[user]["category"],
                    report_users[user]["email"],
                    report_users[user]["mobile"],
                    report_users[user]["subject"].toString(),
                    report_users[user]["specialization"].toString(),
                    report_users[user]["super_specialization"].toString(),
                    qualification.toString(),
                    report_users[user]['isworking'],
                    report_users[user]['designation'],
                    report_users[user]['serving'],
                    report_users[user]['organization_name'],
                    exp.toString(),
                    language.toString(),
                    report_users[user]["line_1"] +
                        " " +
                        report_users[user]["district"] +
                        "," +
                        report_users[user]["state"] +
                        ",Pincode: " +
                        report_users[user]["pincode"],
                ];
                report_table.row.add(innerhtml).draw();
            });
           
        }
        $('#LoaderModal').modal('hide');
    }

    function userAge(dob) {
        var from = dob.split("/");
        var birthdateTimeStamp = new Date(from[2], from[1] - 1, from[0]);
        var cur = new Date();
        var diff = cur - birthdateTimeStamp;
        // This is the difference in milliseconds
        var currentAge = Math.floor(diff / 31557600000);
        // Divide by 1000*60*60*24*365.25

        return currentAge;
    }

    $("#report_subject").change(() => {
        setReportUsers();
    });
    $("#report_specialization").change(() => {
        setReportUsers();
    });
    $("#report_super_specialization").change(() => {
        setReportUsers();
    });
    $("#t_experience").change(() => {
        setReportUsers();
    });
    $("#report_language").change(() => {
        setReportUsers();
    });
    $("#w_status").change(() => {
        setReportUsers();
    });
    $("#designation").change(() => {
        setReportUsers();
    });
    $("#gender").change(() => {
        setReportUsers();
    });
    $("#report_qual").change(() => {
        setReportUsers();
    });
    $("#report_experts").change((e) => {
        if (e.target.value === "Blacklisted") {
            if (!$("#report-from").parent().parent().hasClass("d-none")) {
                $("#report-from").parent().parent().addClass("d-none");
            }
            if (!$("#report-to").parent().parent().hasClass("d-none")) {
                $("#report-to").parent().parent().addClass("d-none");
            }
        } else {
            $("#report-from").parent().parent().removeClass("d-none");
            $("#report-to").parent().parent().removeClass("d-none");
            $("#report-from").val("");
            $("#report-to").val("");
        }
        setReportUsers();
    });
    $("#age").change(() => {
        setReportUsers();
    });

    $("#district").change(() => {
        setReportUsers();
    });

    $("#state").change((e) => {
        $("#district").find("option").not(":first").remove();
        setReportUsers();
        if (e.target.value !== "") {
            states[e.target.value].forEach((district) => {
                $("#district").append(
                    `<option value="${district.district_name}">${district.district_name}</option>`
                );
            });
        }
    });

    // $("#report-from").change(() => {
    //     setReportUsers();
    // });

    // $("#report-to").change(() => {
    //     console.log($("#report-to").val())
    //     setReportUsers();
    // });

    $("#report-from").datepicker({
        // changeMonth: true,
        // changeYear: true,
        format: "dd/mm/yyyy",
        change: function (e) {
            $("#report-to").datepicker('destroy')
            changeDates(e.target.value,'to','minDate','from','maxDate')
        }
        // yearRange: "1957:2025",
    });

    $("#report-to").datepicker({
        // changeMonth: true,
        // changeYear: true,
        format: "dd/mm/yyyy",
        change: function (e) {
            $("#report-from").datepicker().destroy()
            changeDates(e.target.value,'from','maxDate','to','minDate')
        }
    });

    function changeDates(value,type,date,type2,date2){
        $("#report-"+type).datepicker({
            format: "dd/mm/yyyy",
            value:$('#report-'+type).val(),
            [date]:value,
            change:function(e){
                $("#report-"+type2).datepicker().destroy()
                changeDates(e.target.value,type2,date2,type,date)
            }
        });
        setReportUsers();
    }

    function dateFrom(from, check) {
        var fDate, cDate;
        fDate = Date.parse(
            from.split("/")[1] + "/" + from.split("/")[0] + "/" + from.split("/")[2]
        );
        cDate = Date.parse(check);
        if (cDate >= fDate) {
            return true;
        }
        return false;
    }

    function dateTo(to, check) {
        var lDate, cDate;
        lDate = Date.parse(
            to.split("/")[1] + "/" + to.split("/")[0] + "/" + to.split("/")[2]
        );
        cDate = Date.parse(check);
        if (cDate <= lDate) {
            return true;
        }
        return false;
    }

    function resetFilters() {
        $(".report-filters").val("");
        $("#report_specialization").empty();
        $("#report_super_specialization").empty();
        $("#report_specialization").append(`<option value="">Select</option>`);
        $("#report_super_specialization").append(
            `<option value="">Select</option>`
        );
        $("#report-to").datepicker('destroy')
        $("#report-from").datepicker('destroy')
        changeDates($('#report-from').val(),'to','minDate','from','maxDate')
        changeDates($('#report-to').val(),'from','maxDate','to','minDate')
        setReportUsers();
    }

    // $('#report-from').change(()=>{
    //     console.log('from')
    //     $("#report-from").datepicker().destroy()
    //     $("#report-to").datepicker({
    //         // changeMonth: true,
    //         // changeYear: true,
    //         format: "dd/mm/yyyy",
    //         minDate:$('#report-from').val()
    //         // yearRange: "1957:2025",
    //     });
    // })

    // $('#report-to').change(()=>{
    //     $("#report-from").datepicker().destroy()
    //     $("#report-from").datepicker({
    //         // changeMonth: true,
    //         // changeYear: true,
    //         format: "dd/mm/yyyy",
    //         maxDate:$('#report-to').val()
    //         // yearRange: "1957:2025",
    //     });
    // })

    $('.btn-reset').click(()=>{
        resetFilters()
    })

})
