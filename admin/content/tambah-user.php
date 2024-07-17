<?php
if (isset($_POST['simpan'])) {
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    $id_level = $_POST['level'];

    //MASUKKAN KE DALAM TABEL USER (FIELD YANG AKAN DI MASUKKAN)
    //VALUE (INPUTAN MASING-MASING KOLOM)

    $insert = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap, id_level, email, password) VALUES ('$nama_lengkap',$id_level,'$email','$password')");
    if (!$insert) {
        header("location:?pg=tambah-user&pesan=tambah-gagal");
    } else {
        header("location:?pg=user&pesan=tambah-berhasil");
    }
}


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

if (isset($_POST['edit'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $id_level = $_POST['level'];

    $id = $_GET['edit'];

    $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', password='$password', id_level=$id_level WHERE id='$id'");
    header("location:?pg=user&update=berhasi");
}


?>

<form action="" method="post">
    <div class="mb-3">
        <label for="">Nama Lengkap</label>
        <input value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_lengkap'] : '' ?>" type="text" class="form-control" placeholder="Masukkan Nama Lengkap Anda" name="nama_lengkap">
    </div>
    <div class="mb-3">
        <label for="">Email</label>
        <input value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>" type="email" class="form-control" placeholder="Masukkan Email Anda" name="email">
    </div>
    <div class="mb-3">
        <label for="">Password</label>
        <input value="" type="password" class="form-control" placeholder="Masukkan Password Anda" name="password">
    </div>
    <div class="mb-3">
        <?php
        // Assuming $koneksi is your database connection
        $query = mysqli_query($koneksi, "SELECT * FROM level");

        // Check if query executed successfully
        if ($query) {
        ?>
            <label for="level">Level</label>
            <select name="level" id="level"> <!-- Set meaningful name and id -->
                <option value="">-- Pilih Level--</option>
                <?php
                // Loop through fetched data
                while ($queryData = mysqli_fetch_assoc($query)) {
                ?>
                    <option value="<?php echo $queryData['id']; ?>"><?php echo $queryData['nama_level']; ?></option>
                    <!-- Output each option using fetched data -->
                <?php
                }
                ?>
            </select>
        <?php
        } else {
            // Handle query execution failure if needed
            echo "Failed to fetch data.";
        }
        ?>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Simpan" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>">
    </div>
</form>