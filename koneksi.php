<?php

$conn = mysqli_connect("localhost", "root", "", "logincrudpage_");

if (!$conn){
    echo "Koneksi gagal!";
}
