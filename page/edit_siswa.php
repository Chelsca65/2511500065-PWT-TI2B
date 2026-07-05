<?php
require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$kd' "));

if (isset($_POST['tambah'])) {
    $nis = $_POST['nis'];
    $nm_siswa = $_POST['nm_siswa'];
    $id_kelas = $_POST['id_kelas'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $id_kelas = $_POST['id_kelas'];

    $insert = mysqli_query($koneksi, "UPDATE siswa SET nm_siswa='$nm_siswa', id_kelas='$id_kelas', jenkel='$jenkel', hp='$hp' WHERE  nis='$nis' ");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" contents="1;url=index.php?page=siswa">';
    } else {
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
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" id="nis" value="<?= $edit['nis']; ?>" placeholder="Nis" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_siswa">Nama Siswa</label>
                            <input type="text" name="nm_siswa" id="nm_siswa" value="<?= $edit['nm_siswa']; ?>" placeholder="Nama Siswa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" class="form-control">
                                <?php
                                $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($k = mysqli_fetch_array($kelas)) {
                                ?>
                                    <option value="<?= $k['id_kelas']; ?>"
                                        <?php if ($edit['id_kelas'] == $k['id_kelas']) echo "selected"; ?>>
                                        <?= $k['nm_kelas']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenkel">jenis kelamin</label>
                            <input type="text" name="jenkel" id="jenkel" value="<?= $edit['jenkel']; ?>" placeholder="jenis kelamin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="hp">No Hp</label>
                            <input type="text" name="hp" id="hp" value="<?= $edit['hp']; ?>" placeholder="Hp" class="form-control">
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