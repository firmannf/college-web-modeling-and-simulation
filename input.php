<?php
if (isset($_POST['submit'])) {
    $jumlah = $_POST['jumlah'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Model Simulasi Uji Laboratorium Alat Penjernih Air Minum</title>
</head>

<body>
    <div class="header-text">
        <h2>Model Simulasi Uji Laboratorium Alat Penjernih Air Minum</h2>
        <p class="subtitle">MOSI 8 &middot; Kelompok 5</p>
    </div>
    <div class="container">
        <div class="card center" style="width: 80%;">
            <form method="post" action="hasil.php">
                <div class="form-group">
                    <p class="title">Nilai Yi</p>
                    <p class="subtitle">Masukkan nilai Yi</p>
                    <?php
                    for ($i=1; $i <= $jumlah; $i++) { 
                    ?>
                        <input class="form-control" type="number" name="y<?php echo $i;?>" placeholder="Y<?php echo $i;?>" step="0.00001" required/>
                        <br/>
                    <?php    
                    }
                    ?>
                    
                    <input type="hidden" name="jumlah" value="<?php echo $jumlah?>" />
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
</body>

</html>
<?php
}
?>