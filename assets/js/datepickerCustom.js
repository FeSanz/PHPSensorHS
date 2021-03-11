$(function () {
    $("#startDateValue").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: "2021-02-11",
        maxDate: "0"
    });
    
    $("#endDateValue").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: "2021-02-11",
        maxDate: "0"
    });
    
});

$(document).ready(function ()
{
    $("#serachButton").click(function ()
    {
        var startDateValue = $("#startDateValue").val();
        var endDateValue = $("#endDateValue").val();
        
        var difference = (Date.parse(endDateValue) - Date.parse(startDateValue)) / (86400000 * 7);
        if (difference < 0) {
            $("#responseSearch").html("La fecha de inicio debe ser anterior a la fecha de finalización.");
        }
        else
        {
            $("#responseSearch").html("");
            
        jQuery.ajax({
            type: "GET",
            url: 'api.php',
            dataType: 'json',
            data: {api_humedity: 'get_humedity_dates', startDate: startDateValue, endDate: endDateValue},
            success: function (jsonObj) {
                //$("#responseSearch").html(objt.message);
                if (!jsonObj.error)
                {
                    if(jQuery.isEmptyObject(jsonObj.humedadates))
                    {
                        alertify.error('Sin datos. Seleccione otra fecha');
                        document.getElementById("debugTextGraphic").innerHTML = "No se encontraron registros de la fecha seleccionada, intente con otra fecha";
                    }
                    else
                    {
                         //$("#curve_chart").show(300);
                        alertify.success(jsonObj.message);
                        //$("#messageChart").hide();
                        document.getElementById("debugTextGraphic").innerHTML = jsonObj.message;
                        drawDash(jsonObj);
                    }
                }
                else
                {
                    document.getElementById("debugTextGraphic").innerHTML = jsonObj.message;
                }
                
            }
        });
    }
    
    });
});

google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawDash);

function drawDash(obj) 
{
    var data = [];
    var Header = ['Fecha', 'Porcentaje'];
    data.push(Header);

    var i;
    for (i in obj.humedadates)
    {
        var temp = [];
        temp.push(obj.humedadates[i].date_time);
        temp.push(obj.humedadates[i].percentage);

        data.push(temp);
    }
    var chartdata = new google.visualization.arrayToDataTable(data);

    var options = {
        title: 'Datos de humedad del suelo',
        curveType: 'function',
        legend: {position: 'bottom'}
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(chartdata, options); 
}

