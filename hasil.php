<?php
if (isset($_POST['submit'])) {
    $jumlah = $_POST['jumlah'];
    $yi = array();
    for ($i=1; $i <= $jumlah; $i++) { 
        $yi[$i] = $_POST['y' . $i];
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
    <title>Model Simulasi Uji Laboratorium Alat Penjernih Air Minum</title>
</head>

<body>
    <div class="header-text">
        <h2>Model Simulasi Uji Laboratorium Alat Penjernih Air Minum</h2>
        <p class="subtitle" style="color: #009688;">MOSI 8 &middot; Kelompok 5</p>
    </div>
    <div class="container">
        <div class="table-responsive card center" style="width: 80%;">
            <p class="title">Tabel Perhitungan</p>
            <p class="subtitle">Tabel perhitungan menggunakan metode resiprok</p>
            <table class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th align="top">No</th>
                        <th>Waktu Pengamatan Bulan ke (Xi)</th>
                        <th>Kadar Pertikel Air Minum (mg) (Yi)</th>
                        <th>Xi / Yi</th>
                        <th>1 / Yi</th>
                        <th>Xi<sup>2</sup></th>
                        <th>A</th>
                        <th>B</th>
                        <th>a</th>
                        <th>b</th>
                        <th>Y = a / (1 + bx)</th>
                        <th>Error</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $xi = array();
                    $xi_per_yi = array();
                    $one_per_yi = array();
                    $xi_sqr = array();
                    $b_big = array();

                    $sum_xi = 0;
                    $sum_yi = 0;
                    $sum_xi_per_yi = 0;
                    $sum_one_per_yi = 0;
                    $sum_xi_sqr = 0;
                    for ($i=1; $i <= $jumlah; $i++) { 
                        $xi[$i] = $i;
                        $xi_per_yi[$i] = round($i / $yi[$i], 5);
                        $one_per_yi[$i] = round(1 / $yi[$i], 5);
                        $xi_sqr[$i] = pow($i, 2);
                        
                        $sum_xi = $sum_xi + $i;
                        $sum_yi = $sum_yi + $yi[$i];
                        $sum_xi_per_yi = $sum_xi_per_yi + $xi_per_yi[$i];
                        $sum_one_per_yi = $sum_one_per_yi + $one_per_yi[$i];
                        $sum_xi_sqr = $sum_xi_sqr + $xi_sqr[$i];
                    }

                    $avg_xi = $sum_xi / $jumlah;
                    $avg_yi = $sum_yi / $jumlah;
                    $avg_xi_per_yi = $sum_xi_per_yi / $jumlah;
                    $avg_one_per_yi = $sum_one_per_yi / $jumlah;
                    $avg_xi_sqr = $sum_xi_sqr / $jumlah;

                    $b_big = round(((10 * $sum_xi_per_yi) - ($sum_xi * $sum_one_per_yi)) / ((10 * $sum_xi_sqr) - pow($sum_xi, 2)), 5);
                    $a_big = round(($avg_one_per_yi - ($b_big * $avg_xi)), 5);
                    $a_small = round(1 / $a_big, 5);
                    $b_small = round($b_big * $a_small, 5);
                    
                    $yi_result = array();
                    $error = array();
                    $xi_and_yi = array();
                    $xi_and_yi_result = array();

                    $sum_error = 0;
                    for ($i=1; $i <= $jumlah ; $i++) { 
                        $yi_result[$i] = round($a_small / (1 + ($b_small * $i)), 5);
                        $error[$i] = round(abs($yi_result[$i] - $yi[$i]), 5);
                        $xi_and_yi[$i] = array("x" => $xi[$i], "y" => $yi[$i]);
                        $xi_and_yi_result[$i] = array("x" => $xi[$i], "y" => $yi_result[$i]);
                        $sum_error = $sum_error + $error[$i];
                    }
                    
                    $yi_long_term_result = array();
                    $xi_and_yi_long_term_result = array();
                    for ($i=1; $i <= 650; $i++) { 
                        $yi_long_term_result[$i] = round($a_small / (1 + ($b_small * $i)), 5);
                        $xi_and_yi_long_term_result[$i] = array("x" => $i, "y" => $yi_long_term_result[$i]);
                    }

                    for ($i=1; $i <= $jumlah; $i++) { 
                    ?>                        
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $xi[$i];?></td>
                            <td><?php echo $yi[$i];?></td>
                            <td><?php echo $xi_per_yi[$i];?></td>
                            <td><?php echo $one_per_yi[$i];?></td>
                            <td><?php echo $xi_sqr[$i];?></td>
                            <td><?php echo $a_big;?></td>
                            <td><?php echo $b_big;?></td>
                            <td><?php echo $a_small;?></td>
                            <td><?php echo $b_small;?></td>
                            <td><?php echo $yi_result[$i];?></td>
                            <td><?php echo $error[$i];?></td>
                        </tr>  
                    <?php
                    }
                    
                    $json_xi_and_yi = json_encode(array_values($xi_and_yi), JSON_NUMERIC_CHECK);
                    $json_xi_and_yi_result = json_encode(array_values($xi_and_yi_result), JSON_NUMERIC_CHECK);
                    $json_xi_and_yi_long_term_result = json_encode(array_values($xi_and_yi_long_term_result), JSON_NUMERIC_CHECK);
                    ?>  

                    <tr>
                        <td><b>Jumlah</b></td>
                        <td><?php echo $sum_xi;?></td>
                        <td><?php echo $sum_yi;?></td>
                        <td><?php echo $sum_xi_per_yi;?></td>
                        <td><?php echo $sum_one_per_yi;?></td>
                        <td><?php echo $sum_xi_sqr;?></td>
                        <td colspan="5" style="background-color: #FAFAFA;"></td>
                        <td><?php echo $sum_error;?></td>
                    </tr>
                    <tr>
                        <td><b>Rata - Rata</b></td>
                        <td><?php echo $avg_xi;?></td>
                        <td><?php echo $avg_yi;?></td>
                        <td><?php echo $avg_xi_per_yi;?></td>
                        <td><?php echo $avg_one_per_yi;?></td>
                        <td><?php echo $avg_xi_sqr;?></td>
                        <td colspan="6" style="background-color: #FAFAFA;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br/>

        <div class="card center" style="width: 80%;">
            <p class="title">Grafik Perhitungan</p>
            <p class="subtitle">Grafik perhitungan menggunakan metode resiprok</p>
            <canvas id="grafik_perhitungan"></canvas>
        </div>
        
        <br/>

        <div class="card center" style="width: 80%;">
            <p class="title">Grafik Perhitungan Simulasi Jangka Panjang</p>
            <p class="subtitle">Grafik perhitungan simulasi jangka panjang menggunakan metode resiprok</p>
            <canvas id="grafik_perhitungan_simulasi_jangka_panjang"></canvas>
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
                data: <?php echo print_r($json_xi_and_yi, true); ?>
            }, {
                label: "Data simulasi",
                borderColor: window.chartColors.blue,
                backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                data: <?php echo print_r($json_xi_and_yi_result, true); ?>
            }]
        };
        
        var scatterChartDataLongTerm = {
            datasets: [{
                label: "Data simulasi",
                borderColor: window.chartColors.blue,
                backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                data: <?php echo print_r($json_xi_and_yi_long_term_result, true); ?>
            }]
        };

        $(document).ready(function () {
            var ctx = document.getElementById("grafik_perhitungan").getContext("2d");
            window.myScatter = Chart.Scatter(ctx, {
                data: scatterChartData,
                options: {
                    animation: {
                        duration: 2000
                    }
                }
            });
            
            var ctxLongTerm = document.getElementById("grafik_perhitungan_simulasi_jangka_panjang").getContext("2d");
            window.myScatter = Chart.Scatter(ctxLongTerm, {
                data: scatterChartDataLongTerm,
                options: {
                    animation: {
                        duration: 2000
                    }
                }
            });
        });
    </script>
</body>

</html>
<?php
}
?>