google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    
    var today = new Date();
    
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today =  yyyy + '-' + mm + '-' + dd;

    jQuery.ajax({
        type: "GET",
        url: 'api.php',
        dataType: 'json',
        data: {api_humedity: 'get_humedity_dates', startDate: today, endDate: today},
        success: function (obj)
        {            
            if (!obj.error && !jQuery.isEmptyObject(obj.humedadates))
            {
                document.getElementById("debugTextGraphic").innerHTML = obj.message;
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
            else
            {
                if(jQuery.isEmptyObject(obj.humedadates))
                {
                    //$("#messageChart").show(300);
                    alertify.error('Seleccione otra fecha');
                    //$("#curve_chart").hide();
                    document.getElementById("debugTextGraphic").innerHTML = "No se encontraron registros de hoy seleccione otra fecha";
                }
                else
                {
                    document.getElementById("debugTextGraphic").innerHTML = obj.message;
                }
                
            }
        }
    });
}