/**
 * Created by mosaddek on 2/2/15.
 */

//date picker start


if (top.location != location) {
    top.location.href = document.location.href ;
}

function daysInMonth(month,year) {
    var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
    return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
}

function printTime(offset, date) {
    offset++;
    tempDate = new Date()
    tempDate.setTime(date.getTime()+3600000*(offset))
    timeValue = ((tempDate.getHours()<10) ? ("0"+tempDate.getHours()) : (""+tempDate.getHours()))
    timeValue += ((tempDate.getMinutes()<10) ? ("0"+tempDate.getMinutes()) : tempDate.getMinutes())
    timeValue += " hrs."
    return timeValue
}

$(function(){

    window.prettyPrint && prettyPrint();
    $('.default-date-picker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    $('.dpYears').datepicker({
        autoclose: true
    });
    $('.dpMonths').datepicker({
        autoclose: true
    });

    // disabling dates
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('.dpd1').datepicker({
        format: 'dd/mm/yyyy',
        timezone:"UTC/GMT",
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {

        // var localTime = new Date();
        // var ptTime = new Date();
        // ptTime.setMinutes(ptTime.getMinutes() + localTime.getTimezoneOffset() - 420);
        // alert(localTime + ' ' + localTime.getTimezoneOffset() + ' ' + ptTime);

        checkin.setValue(new Date(ev.date));

        if(checkout!=null && checkout.date !=null){
            if (ev.date.valueOf() > checkout.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
            }
        }

        checkin.hide();
        $('.dpd2')[0].focus();
    }).data('datepicker');

    var checkout = $('.dpd2').datepicker({
        format: 'dd/mm/yyyy',
        onRender: function(date) {
            // return (date.valueOf() < now.valueOf()) && (date.valueOf()>= checkin.date.valueOf()) ? '' : 'disabled';
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if((ev!=null && ev.date) !=null && (checkin!=null && checkin.viewDate!=null)){
            if (ev.date.valueOf() < checkin.viewDate.getTime()) {
                $("#txtValidade").html('');
                $(this).val('');
                checkout.show();
                toastr.error("Intervalo de data inválido.");
            }
            else {

                var timeDiff = Math.abs(checkout.getDate().getTime() - checkin.getDate().getTime());
                var daysDifference = Math.ceil(timeDiff / (1000 * 3600 * 24));
                //var daysDifference = Math.floor(timeDiff / 1000 / 60 / 60 / 24)+1;
                var meses = (Math.round((daysDifference<30 ? 30 : daysDifference)/30));

                var dados = daysDifference + " dias";
                if(daysDifference>30){
                    dados+="| "+meses+" mes(es).";
                }

                toastr.info(dados);
                $("#txtValidade").html(': '+dados);
                checkout.hide();
            }
        }
    }).data('datepicker');
});

//date picker end
//TODO POOOG

// $('.dpd1').datepicker({
//     language: "pt-BR",
//     format: 'dd/mm/yyyy',
//     days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
//     daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
//     daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa", "Do"],
//     months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
//     monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
//     today: "Hoje",
//     clear: "Limpar",
//     titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
//     weekStart: 0,
//     startDate:"0d",
//     todayHighlight: true,
//     autoclose: true
// });
//
// $('.dpd2').datepicker({
//     language: "pt-BR",
//     format: 'dd/mm/yyyy',
//     days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
//     daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
//     daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa", "Do"],
//     months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
//     monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
//     today: "Hoje",
//     clear: "Limpar",
//     titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
//     weekStart: 0,
//     startDate:"0d",
//     todayHighlight: true,
//     autoclose: true
// });

//datetime picker start

$(".form_datetime").datetimepicker({
    format: "dd/mm/yyyy hh:ii",
    autoclose: true,
    todayBtn: true,
    pickerPosition: "bottom-left"

});


$(".form_datetime-component").datetimepicker({
    format: "dd/mm/yyyy hh:ii",
    autoclose: true,
    todayBtn: true,
    pickerPosition: "bottom-left"
});

$(".form_datetime-adv").datetimepicker({
    format: "dd MM yyyy - hh:ii",
    autoclose: true,
    todayBtn: true,
    startDate: "2013-02-14 10:00",
    minuteStep: 10,
    pickerPosition: "bottom-left"

});

$(".form_datetime-meridian").datetimepicker({
    format: "dd MM yyyy - HH:ii P",
    showMeridian: true,
    autoclose: true,
    todayBtn: true,
    pickerPosition: "bottom-left"
});

//datetime picker end

//timepicker start
$('.timepicker-default').timepicker();


$('.timepicker-24').timepicker({
    autoclose: true,
    minuteStep: 1,
    showSeconds: true,
    showMeridian: false
});

//timepicker end

//colorpicker start

$('.colorpicker-default').colorpicker({
    format: 'hex'
});
$('.colorpicker-rgba').colorpicker();

//colorpicker end

