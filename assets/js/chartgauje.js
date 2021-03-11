google.charts.load('current', {'packages': ['gauge']});
google.charts.setOnLoadCallback(drawChartGuage);

function drawChartGuage()
{
    jQuery.ajax({
        type: "GET",
        url: 'api.php',
        dataType: 'json',
        data: {api_humedity: 'get_current_humedity'},
        success: function (obj)
        {
            if (!obj.error)
            {
                document.getElementById("debugTextManometer").innerHTML = "Estado actual del sensor";

                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Porcentaje', obj.current[0].percentage],
                    ['Rango', obj.current[0].rango]
                ]);

                var options = {
                    width: 500, height: 220,
                    greenFrom: 50, greenTo: 100,
                    yellowFrom: 35, yellowTo: 50,
                    redFrom: 0, redTo: 35,
                    minorTicks: 5
                };

                var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                chart.draw(data, options);
            } else
            {
                document.getElementById("debugTextManometer").innerHTML = "Error en la consulta";
            }
            
        }
    });


setTimeout(function(){ drawChartGuage(); }, 3000);
   /* var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['Porcentaje', 80],
        ['Rango', 1023]
    ]);

    var options = {
        width: 500, height: 220,
        greenFrom: 50, greenTo: 100,
        yellowFrom: 35, yellowTo: 50,
        redFrom: 0, redTo: 35,
        minorTicks: 5
    };

    var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

    chart.draw(data, options);*/

    /*setInterval(function() {
     data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
     chart.draw(data, options);
     }, 13000);
     setInterval(function() {
     data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
     chart.draw(data, options);
     }, 5000);
     setInterval(function() {
     data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
     chart.draw(data, options);
     }, 26000);*/
}


