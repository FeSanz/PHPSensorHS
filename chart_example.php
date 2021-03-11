  <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Fecha', 'Porcentaje'],
          ['2004',  100],
          ['2005',  50],
          ['2006',  12],
          ['2007',  4],
          ['2008',  1],
          ['2009',  100],
          ['2010',  89],
          ['2011',  78],
          ['2012',  67],
          ['2013',  89],
          ['2014',  54],
          ['2015',  34],
          ['2016',  56],
          ['2017',  78],
          ['2018',  89],
          ['2019',  45]
        ]);

        var options = {
          title: 'Datos de humedad del suelo',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>
