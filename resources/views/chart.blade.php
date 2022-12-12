
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Promina Task</title>
</head>
<body>
    <h1>Highcharts represents image count in each album </h1>
    <div id="container"></div>
</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var image_count = <?php echo json_encode($image_count)?>;
    var album =  <?php echo json_encode($album)?>;
    Highcharts.chart('container', {
        chart: {
       type: 'column'
     },
        title: {
            text: 'albums'
        },
        subtitle: {
            text: 'image count in  album'
        },
        xAxis: {
            categories:album
        },
        yAxis: {
            title: {
                text: 'Number of Images'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'images',
            data: image_count
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>
</html>
