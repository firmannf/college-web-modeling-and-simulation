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
            <form method="post" action="input.php">
                <div class="form-group">
                    <p class="title">Jumlah Data</p>
                    <p class="subtitle">Masukkan jumlah data yang akan diproses</p>
                    <input class="form-control" type="number" name="jumlah" required/>
                    <br/>
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