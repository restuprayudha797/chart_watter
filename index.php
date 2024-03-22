<?php
function bacaFile($namaFile)
{
    $data = array();
    $file = fopen($namaFile, "r");

    while (!feof($file)) {
        $baris = fgets($file);
        $data[] = explode(",", $baris);
    }

    fclose($file);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .highcharts-figure {
            width: 95%;
            margin-top: 200px;
        }

        #container {
            height: 450px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
</head>

<body>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <center>
        <h1 style="margin-top: 200px;">Grafik Ketinggian Air</h1>
    </center>
    <figure class="highcharts-figure" style="margin-top: 100px;">
        <div id="container"></div>
    </figure>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var timeChart = [];
    var dataChart = [];

    chart_grafik = Highcharts.chart('container', {
        chart: {
            type: 'area'
        },
        title: {
            text: ''
        },
        legend: {
            enabled: false // Menonaktifkan legenda
        },
        xAxis: {
            allowDecimals: false,
            categories: timeChart
        },

        yAxis: {
            title: {
                text: 'Value'
            },
            max: 30, // Tetapkan nilai maksimum sumbu y di sini
            reversed: true
        },
        series: [{
            name: 'Ketinggian Air',
            data: dataChart
        }]
    });
    const i = 10;
    setInterval(function($i) {
        $.ajax({
            type: "POST",
            url: "getDataConf.php",
            data: 'tes',
            dataType: "json",
            success: function(response) {

                dataChart.push(parseInt(response[0]));
                timeChart.push(response[1]);

                updateChart(dataChart, timeChart);
            }
        });

    }, 1000);

    function updateChart(series, xAxis) {
        chart_grafik.series[0].update({
            data: Object.values(series)
        });
        chart_grafik.xAxis[0].update({
            categories: xAxis
        });
    }
</script>

</html>