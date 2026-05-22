<?php
require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Ekstrakulikuler</h1>
            </div>
        </div>
    </div>
</div> 

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM ekstra_2511500065 WHERE id_ekstra065='$kd' "));

if(isset($_POST['tambah'])){
    $id_ekstra065 = $_POST['id_ekstra065'];
    $nama_ekstra065 = $_POST['nama_ekstra065'];
    $ket065 = $_POST['ket065'];
    $semester065 = $_POST['semester065'];
    $thn_ajaran065 = $_POST['thn_ajaran065'];

    $insert = mysqli_query($koneksi,"UPDATE mapel SET nama_ekstra065='$nama_ekstra065', ket065='$ket065', semester065= '$semester065', thn_ajaran065= '$thn_ajaran065' WHERE id_ekstra065='$id_ekstra065' ");
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
                                <input type="text"name="id_ekstra065" value="<?= $edit['id_ekstra065']; ?>" placeholder="Id eskul" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_ekstra065">Nama Ekstrakulikuler</label>
                                <input type="text" name="nama_ekstra065" id="nama_ekstra065" value="<?= $edit['nama_ekstra065']; ?>" placeholder="keterangan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ket065">Keterangan</label>
                                <input type="text" name="ket065" id="ket065" value="<?= $edit['ket065']; ?>" placeholder="keterangan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="semester065">Semester</label>
                                <input type="text" name="semester065" id="semester065" value="<?= $edit['semester065']; ?>" placeholder="semester" class="form-control">
                            </div>
                             <div class="form-group">
                                <label for="thn_ajaran065">Tahun Ajaran</label>
                                <input type="text" name="thn_ajaran065" id="thn_ajaran065" value="<?= $edit['thn_ajaran065']; ?>" placeholder="Tahun Ajaran" class="form-control">
                            </div>

                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

