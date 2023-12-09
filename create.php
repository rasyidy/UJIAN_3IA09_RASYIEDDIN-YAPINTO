<!DOCTYPE html>
<html>
<head>
    <title>Form Mahasiswa MBKM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["nama"]);
        $perguruan_tinggi=input($_POST["perguruan_tinggi"]);
        $jurusan=input($_POST["jurusan"]);
        $nim=input($_POST["nim"]);
        $program_mbkm=input($_POST["program_mbkm"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into mahasiswa (nama,perguruan_tinggi,jurusan,nim,program_mbkm) values
		('$nama','$perguruan_tinggi','$jurusan','$nim','$program_mbkm')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Perguruan Tinggi:</label>
            <input type="text" name="perguruan_tinggi" class="form-control" placeholder="Masukan Nama Universitas" required/>
        </div>
       <div class="form-group">
            <label>Jurusan :</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" required/>
        </div>
                </p>
        <div class="form-group">
            <label>NIM:</label>
            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM anda" required/>
        </div>
        <div class="form-group">
            <label>Program MBKM yang diambil:</label>
            <input type="text" name="program_mbkm" class="form-control" placeholder="Masukkan Program MBKM anda" required/>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>