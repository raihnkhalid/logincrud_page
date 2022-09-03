<?php
include "koneksi.php";
session_start();

if (!$_GET['id']) {
    header("Location:home.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM dataorang WHERE id='$id'");
    if ($query) {
        header("Location:home.php");
    }
}