<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];

    //MASUKKAN KE DALAM TABEL USER (FIELD YANG AKAN DI MASUKKAN)
    //VALUE (INPUTAN MASING-MASING KOLOM)

    $insert = mysqli_query($koneksi, "INSERT INTO testimoni (nama, jabatan, deskripsi) VALUES ('$nama','$jabatan','$deskripsi')");
    if (!$insert) {
        header("location:?pg=tambah-testimoni&pesan=tambah-gagal");
    } else {
        header("location:?pg=testimoni&pesan=tambah-berhasil");
    }
}


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $edit = mysqli_query($koneksi, "SELECT * FROM testimoni WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];

    $id = $_GET['edit'];

    $update = mysqli_query($koneksi, "UPDATE testimoni SET nama='$nama', jabatan='$jabatan', deskripsi='$deskripsi' WHERE id='$id'");
    header("location:?pg=testimoni&update=berhasi");
}


?>

<form action="" method="post">
    <div class="mb-3">
        <label for="">Nama</label>
        <input value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>" type="text" class="form-control" placeholder="Masukkan Nama Anda" name="nama">
    </div>
    <div class="mb-3">
        <label for="">Jabatan</label>
        <input value="<?php echo isset($_GET['edit']) ? $rowEdit['jabatan'] : '' ?>" type="text" class="form-control" placeholder="Masukkan Jabatan Anda" name="jabatan">
    </div>
    <div class="mb-3">
        <label for="">Deskripsi</label>
        <textarea name="deskripsi" id="" class="form-control" placeholder="Masukkan Deskripsi"><?php echo isset($_GET['edit']) ? $rowEdit['deskripsi'] : '' ?></textarea>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Simpan" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>">
    </div>
</form>