<!DOCTYPE html>
<html>
<head>
    <title>Form Informasi Mahasiswa MBKM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //kita Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['id_mahasiswa'])) {
        $id_mahasiswa=input($_GET["id_mahasiswa"]);

        $sql="select * from mahasiswa where id_mahasiswa=$id_mahasiswa";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_mahasiswa=htmlspecialchars($_POST["id_mahasiswa"]);
        $nama=input($_POST["nama"]);
        $perguruan_tinggi=input($_POST["perguruan_tinggi"]);
        $jurusan=input($_POST["jurusan"]);
        $nim=input($_POST["nim"]);
        $program_mbkm=input($_POST["program_mbkm"]);

        //Query update data pada tabel anggota
        $sql="update mahasiswa set
			nama='$nama',
			perguruan_tinggi='$perguruan_tinggi',
			jurusan='$jurusan',
			nim='$nim',
			program_mbkm='$program_mbkm'
			where id_mahasiswa=$id_mahasiswa";

        //kita akan Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //kita cek Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
        <div class="form-group">
            <label>NIM :</label>
            <input type="text" name="nim" class="form-control" placeholder="Masukan NIM anda" required/>
        </div>
        <div class="form-group">
            <label>Program MBKM yang diambil:</label>
            <input type="text" name="program_mbkm" class="form-control" placeholder="Masukan Program MBKM anda" required/>
        </div>

        <input type="hidden" name="id_mahasiswa" value="<?php echo $data['id_mahasiswa']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>