<?php
if (isset($_POST['submit'])) {
    $jumlah = $_POST['jumlah'];
    $y = array();
    for ($i=1; $i <= $jumlah; $i++) { 
        $y[$i] = $_POST['y' . $i];
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Model Simulasi Terlarutnya Obat dalam Darah</title>
</head>

<body>
    <div class="header-text">
        <h2>Model Simulasi Terlarutnya Obat dalam Darah</h2>
        <p class="subtitle" style="color: #009688;">MOSI 8 &middot; Kelompok 5</p>
    </div>
    <div class="container">
        <div class="table-responsive card center" style="width: 60%;">
            <p class="title">Tabel Perhitungan</p>
            <p class="subtitle">Tabel perhitungan menggunakan metode respirog</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Xi</th>
                        <th>Yi</th>
                        <th>Xi / Yi</th>
                        <th>1 / Yi</th>
                        <th>Xi<sup>2</sup></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i=1; $i <= $jumlah; $i++) { 
                    ?>                        
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $y[$i];?></td>

                            <?php $xi_per_yi = round($i / $y[$i], 5);?>
                            <td><?php echo $xi_per_yi;?></td>

                            <?php $one_per_yi = round(1 / $y[$i], 5);?>
                            <td><?php echo $one_per_yi;?></td>

                            <?php $xi_sqr = pow($i, 2);?>
                            <td><?php echo $xi_sqr;?></td>
                        </tr>  
                    <?php
                    }
                    ?>  
                </tbody>
            </table>
        </div>

        <br/>

        <div class="card center" style="width: 60%;">
            <p class="title">Grafik Perhitungan</p>
            <p class="subtitle">Grafik perhitungan menggunakan metode respirog</p>
            <canvas id="grafik_perhitungan"></canvas>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/util.js"></script>
    <script>
        var color = Chart.helpers.color;
        var scatterChartData = {
            datasets: [{
                label: "Data asli",
                borderColor: window.chartColors.red,
                backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
                data: [{
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }]
            }, {
                label: "Data simulasi",
                borderColor: window.chartColors.blue,
                backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                data: [{
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                }]
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("grafik_perhitungan").getContext("2d");
            window.myScatter = Chart.Scatter(ctx, {
                data: scatterChartData
            });
        };
    </script>
</body>

</html>
<?php
}
?>