<?php
require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakulikuler</h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis
$carikode = mysqli_query($koneksi,"select max(id_ekstra065) from ekstra_2511500065") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode ="M-".str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {$hasilkode="M-"; }
$_SESSION["KODE"] = $hasilkode;

if(isset($_POST['tambah'])){
    $id_ekstra065 = $_POST['id_ekstra065'];
    $nama_ekstra065 = $_POST['nama_ekstra065'];
    $ket065 = $_POST['ket065'];
    $semester065 = $_POST['semester065'];
    $thn_ajaran065 = $_POST['thn_ajaran065'];

    $insert = mysqli_query($koneksi,"INSERT INTO ekstra_2511500065 values ('$id_ekstra065', '$nama_ekstra065','$ket065','$semester065','$thn_ajaran065')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" contents="1;url=index.php?page=ekstra2511500065">';
    }else{
        echo 'div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
        }
    }
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-2">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="id_ekstra065">Kode Ekstrakulikuler</label>
                                <input type="text"name="id_ekstra065" value="<?= $hasilkode; ?>" placeholder="Id eskul" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_ekstra065">Nama Ekstrakulikuler</label>
                                <input type="text" name="nama_ekstra065" id="nama_ekstra065" placeholder="Nama Ekstrakulikuler" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Ket065">Keterangan</label>
                                <input type="text" name="Ket065" id="Ket065" placeholder="Keterangan" class="form-control">
                            </div>
                             <div class="form-group">
                                <label for="semester065">Semester</label>
                                <input type="text" name="semester065" id="semester065" placeholder="Semester" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="thn_ajaran065">Tahun AJaran</label>
                                <input type="text" name="thn_ajaran065" id="thn_ajaran065" placeholder="Tahun Ajaran" class="form-control">
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    