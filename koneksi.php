<?php

$conn = mysqli_connect("localhost", "root", "", "loginpage_");

if (!$conn){
    echo "Koneksi gagal!";
}
