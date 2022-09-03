<?php

include "koneksi.php";
session_start();
if (!$_SESSION['fullname']) {
    header("Location:login.php");
}


if (isset($_POST['editdata'])) {
    $id = $_POST['id'];
    $namalengkap = $_POST['namalengkap'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];

    $query = mysqli_query($conn, "UPDATE dataorang SET namalengkap='$namalengkap', umur='$umur', alamat='$alamat' WHERE id='$id'");
    if ($query) {
        header("Location:home.php");
    }
}


if ($_POST['idx']) {

    $id = $_POST['idx'];

    $sql = mysqli_query($conn, "SELECT * FROM dataorang WHERE id = $id");

    while ($result = mysqli_fetch_array($sql)) {

?>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="edit.php" method="post">
        <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                <input class="form-control mt-3" type="text" name="namalengkap" placeholder="Nama Lengkap" autocomplete="off" value="<?php echo $result['namalengkap']; ?>">
                <input class="form-control mt-3" type="number" max="99" name="umur" placeholder="Umur" autocomplete="off" value="<?php echo $result['umur']; ?>">
                <input class="form-control mt-3" type="text" name="alamat" placeholder="Alamat" autocomplete="off" value="<?php echo $result['alamat']; ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="editdata">Simpan</button>
        </div>
        </form>

<?php }
}

?>